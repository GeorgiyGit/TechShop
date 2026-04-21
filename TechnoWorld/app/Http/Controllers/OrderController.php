<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    private const CHECKOUT_SESSION_KEY = 'checkout';

    private const DELIVERY_FEE_COURIER = 10.00;

    private const STORE_ADDRESS = [
        'country' => 'Slovakia',
        'city' => 'Bratislava',
        'street' => 'Stare Grunty, Karlova Ves',
        'house_number' => '53',
        'post_code' => '841 04',
    ];

    public function items(Request $request): View|RedirectResponse
    {
        $cart = $this->resolveCart($request);
        $cart?->load('items.product.firstImage');

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        return view('order.create-items', [
            'cart' => $cart,
            'itemsCount' => $cart->items->sum('quantity'),
            'subtotal' => $cart->items->sum(fn ($item) => (float) $item->product->price * $item->quantity),
        ]);
    }

    public function contact(Request $request): View|RedirectResponse
    {
        $cart = $this->resolveCart($request);
        if (! $cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index');
        }

        $checkout = $this->checkout($request);
        $contact = $checkout['contact'] ?? $this->defaultContact();

        return view('order.create-contact', [
            'contact' => $contact,
        ]);
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:60'],
        ]);

        $checkout = $this->checkout($request);
        $checkout['contact'] = $validated;
        $request->session()->put(self::CHECKOUT_SESSION_KEY, $checkout);

        return redirect()->route('order.create.delivery');
    }

    public function delivery(Request $request): View|RedirectResponse
    {
        if (! $this->hasStep($request, 'contact')) {
            return redirect()->route('order.create.contact');
        }

        $checkout = $this->checkout($request);
        $delivery = $checkout['delivery'] ?? [
            'delivery_method' => 'courier',
            'country' => '',
            'city' => '',
            'street' => '',
            'house_number' => '',
            'post_code' => '',
        ];

        return view('order.create-delivery', [
            'delivery' => $delivery,
            'activeDeliveryMethod' => 'courier',
        ]);
    }

    public function pickup(Request $request): View|RedirectResponse
    {
        if (! $this->hasStep($request, 'contact')) {
            return redirect()->route('order.create.contact');
        }

        $checkout = $this->checkout($request);
        $delivery = $checkout['delivery'] ?? ['delivery_method' => 'pickup'] + self::STORE_ADDRESS;

        return view('order.create-delivery', [
            'delivery' => $delivery,
            'activeDeliveryMethod' => 'pickup',
        ]);
    }

    public function storeDelivery(Request $request): RedirectResponse
    {
        $method = $request->input('delivery_method', 'courier');

        if ($method === 'pickup') {
            $validated = ['delivery_method' => 'pickup'] + self::STORE_ADDRESS;
        } else {
            $validated = $request->validate([
                'delivery_method' => ['required', 'in:courier,pickup'],
                'country' => ['required', 'string', 'max:100'],
                'city' => ['required', 'string', 'max:100'],
                'street' => ['required', 'string', 'max:200'],
                'house_number' => ['required', 'string', 'max:40'],
                'post_code' => ['required', 'string', 'max:20'],
            ]);
        }

        $checkout = $this->checkout($request);
        $checkout['delivery'] = $validated;
        $request->session()->put(self::CHECKOUT_SESSION_KEY, $checkout);

        return redirect()->route('order.create.payment');
    }

    public function payment(Request $request): View|RedirectResponse
    {
        return $this->paymentView($request, 'card');
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $this->hasStep($request, 'contact') || ! $this->hasStep($request, 'delivery')) {
            return redirect()->route('order.create.contact');
        }

        $payment = $request->validate([
            'payment_method' => ['required', 'in:card,google_pay,cash'],
        ]);

        $checkout = $this->checkout($request);
        $checkout['payment'] = $payment;
        $request->session()->put(self::CHECKOUT_SESSION_KEY, $checkout);

        $cart = $this->resolveCart($request);
        $cart?->load('items.product.firstImage');
        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        try {
            $order = DB::transaction(function () use ($request, $cart, $checkout) {
                $subtotal = 0.0;
                $deliveryFee = ($checkout['delivery']['delivery_method'] ?? 'courier') === 'courier'
                    ? self::DELIVERY_FEE_COURIER
                    : 0.0;

                foreach ($cart->items as $item) {
                    $product = Product::whereKey($item->product_id)->lockForUpdate()->first();

                    if (! $product || ! $product->is_active) {
                        throw ValidationException::withMessages([
                            'cart' => 'One of the products in your cart is no longer available.',
                        ]);
                    }

                    if ($product->stock_left < $item->quantity) {
                        throw ValidationException::withMessages([
                            'cart' => 'Not enough stock for ' . $product->name . '.',
                        ]);
                    }

                    $subtotal += (float) $product->price * $item->quantity;
                }

                $order = Order::create([
                    'order_number' => $this->newOrderNumber(),
                    'user_id' => Auth::id(),
                    'session_id' => Auth::check() ? null : $request->session()->getId(),
                    'first_name' => $checkout['contact']['first_name'],
                    'last_name' => $checkout['contact']['last_name'],
                    'email' => $checkout['contact']['email'],
                    'phone' => $checkout['contact']['phone'],
                    'delivery_method' => $checkout['delivery']['delivery_method'],
                    'payment_method' => $checkout['payment']['payment_method'],
                    'country' => $checkout['delivery']['country'],
                    'city' => $checkout['delivery']['city'],
                    'street' => $checkout['delivery']['street'],
                    'house_number' => $checkout['delivery']['house_number'],
                    'post_code' => $checkout['delivery']['post_code'],
                    'subtotal' => round($subtotal, 2),
                    'delivery_fee' => $deliveryFee,
                    'total' => round($subtotal + $deliveryFee, 2),
                    'status' => 'processing',
                    'placed_at' => now(),
                ]);

                foreach ($cart->items as $item) {
                    $product = Product::whereKey($item->product_id)->lockForUpdate()->firstOrFail();

                    $lineTotal = round((float) $product->price * $item->quantity, 2);
                    $order->items()->create([
                        'product_id' => $product->id,
                        'product_brand' => $product->brand,
                        'product_name' => $product->name,
                        'product_slug' => $product->slug,
                        'image_path' => $product->firstImage?->image_path,
                        'unit_price' => $product->price,
                        'quantity' => $item->quantity,
                        'total_price' => $lineTotal,
                    ]);

                    $product->decrement('stock_left', $item->quantity);
                }

                $cart->items()->delete();
                $cart->delete();

                return $order;
            });
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }

        $request->session()->put('checkout.last_order_id', $order->id);
        $request->session()->forget(self::CHECKOUT_SESSION_KEY);

        return redirect()->route('order.success', ['order' => $order->id]);
    }

    public function success(Request $request, ?Order $order = null): View|RedirectResponse
    {
        $order ??= Order::with('items')->find($request->session()->get('checkout.last_order_id'));
        if (! $order) {
            return redirect()->route('home');
        }

        if (! $order->relationLoaded('items')) {
            $order->load('items');
        }

        $this->authorizeOrder($request, $order);

        return view('order.success', [
            'order' => $order,
            'itemsCount' => $order->items->sum('quantity'),
        ]);
    }

    private function paymentView(Request $request, string $defaultMethod): View|RedirectResponse
    {
        if (! $this->hasStep($request, 'contact') || ! $this->hasStep($request, 'delivery')) {
            return redirect()->route('order.create.contact');
        }

        $checkout = $this->checkout($request);
        $selectedMethod = $request->string('payment_method')->toString() ?: ($checkout['payment']['payment_method'] ?? $defaultMethod);
        $payment = $checkout['payment'] ?? ['payment_method' => $selectedMethod];
        $delivery = $checkout['delivery'];

        $cart = $this->resolveCart($request);
        $cart?->load('items.product.firstImage');
        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $subtotal = $cart->items->sum(fn ($item) => (float) $item->product->price * $item->quantity);
        $deliveryFee = ($delivery['delivery_method'] ?? 'courier') === 'courier' ? self::DELIVERY_FEE_COURIER : 0.0;

        return view('order.create-payment', [
            'payment' => $payment,
            'delivery' => $delivery,
            'isCashPage' => $defaultMethod === 'cash',
            'selectedMethod' => $selectedMethod,
            'itemsCount' => $cart->items->sum('quantity'),
            'subtotal' => $subtotal,
            'deliveryFee' => $deliveryFee,
            'total' => $subtotal + $deliveryFee,
        ]);
    }

    private function checkout(Request $request): array
    {
        return $request->session()->get(self::CHECKOUT_SESSION_KEY, []);
    }

    private function hasStep(Request $request, string $step): bool
    {
        $checkout = $this->checkout($request);

        return isset($checkout[$step]);
    }

    private function defaultContact(): array
    {
        if (! Auth::check()) {
            return [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
            ];
        }

        $parts = preg_split('/\s+/', trim(Auth::user()->name));

        return [
            'first_name' => $parts[0] ?? '',
            'last_name' => count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '',
            'email' => Auth::user()->email,
            'phone' => '',
        ];
    }

    private function resolveCart(Request $request): ?Cart
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->first();
        }

        $sessionId = $request->session()->getId();

        return Cart::where('session_id', $sessionId)->first();
    }

    private function authorizeOrder(Request $request, Order $order): void
    {
        if (Auth::check()) {
            abort_if($order->user_id !== Auth::id(), 403);
            return;
        }

        abort_if($order->session_id !== $request->session()->getId(), 403);
    }

    private function newOrderNumber(): string
    {
        do {
            $candidate = now()->format('Y') . '-' . str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (Order::where('order_number', $candidate)->exists());

        return $candidate;
    }
}
