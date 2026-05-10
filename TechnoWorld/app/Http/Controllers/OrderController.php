<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function items(Request $request): View|RedirectResponse
    {
        $cart = $this->resolveCart($request);
        $cart?->load('items.product.brand', 'items.product.firstImage');

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $subtotal = $cart->items->sum(fn($item) => (float) $item->product->price * $item->quantity);
        $itemsCount = $cart->items->sum('quantity');
        return view('order.create-items', compact('cart', 'subtotal', 'itemsCount'));
    }

    public function contact(Request $request): View|RedirectResponse
    {
        $cart = $this->resolveCart($request);

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index');
        }

        $contact = $request->session()->get('order_contact', [
            'first_name' => '',
            'last_name' => '',
            'email' => Auth::user()?->email ?? '',
            'phone' => '',
        ]);
        return view('order.create-contact', compact('contact'));
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:40',
        ]);

        $request->session()->put('order_contact', $request->only('first_name', 'last_name', 'email', 'phone'));
        return redirect()->route('order.create.delivery');
    }

    public function delivery(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('order_contact')) {
            return redirect()->route('order.create.contact');
        }

        if (!$request->session()->has('order_delivery')) {
            $delivery = [
                'delivery_method' => 'courier',
                'country' => '',
                'city' => '',
                'street' => '',
                'house_number' => '',
                'postal_code' => '',
            ];
        } else {
            $delivery = $request->session()->get('order_delivery');
        }
        return view('order.create-delivery', compact('delivery'));
    }

    public function storeDelivery(Request $request): RedirectResponse
    {
        $method = $request->input('delivery_method', 'courier');

        $request->validate(['delivery_method' => 'required|in:courier,pickup']);

        if ($method === 'courier') {
            $request->validate([
                'country' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'street' => 'required|string|max:200',
                'house_number' => 'required|string|max:40',
                'postal_code' => 'required|string|max:20',
            ]);
        }

        $request->session()->put('order_delivery', [
            'delivery_method' => $method,
            'country' => $request->input('country', ''),
            'city' => $request->input('city', ''),
            'street' => $request->input('street', ''),
            'house_number' => $request->input('house_number', ''),
            'postal_code' => $request->input('postal_code', ''),
        ]);
        return redirect()->route('order.create.payment');
    }

    public function payment(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('order_contact')) {
            return redirect()->route('order.create.contact');
        }
        if (!$request->session()->has('order_delivery')) {
            return redirect()->route('order.create.delivery');
        }

        $cart = $this->resolveCart($request);
        $cart?->load('items.product.brand', 'items.product.firstImage');
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $delivery = $request->session()->get('order_delivery');
        $itemsCount = $cart->items->sum('quantity');
        $subtotal = $cart->items->sum(fn($item) => (float) $item->product->price * $item->quantity);
        return view('order.create-payment', compact('cart', 'delivery', 'itemsCount', 'subtotal'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'payment_method' => 'required|in:card,google_pay,cash',
        ]);

        $cart = $this->resolveCart($request);
        $cart?->load('items.product');

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $contact = $request->session()->get('order_contact');
        $delivery = $request->session()->get('order_delivery');

        if (!$contact) {
            return redirect()->route('order.create.contact');
        }
        if (!$delivery) {
            return redirect()->route('order.create.delivery');
        }

        $order = DB::transaction(function () use ($request, $cart, $contact, $delivery) {
            $address = null;
            if (($delivery['delivery_method'] ?? 'courier') === 'courier') {
                $address = Address::create([
                    'country' => $delivery['country'],
                    'city' => $delivery['city'],
                    'street' => $delivery['street'],
                    'house_number' => $delivery['house_number'],
                    'postal_code' => $delivery['postal_code'],
                ]);
            }

            $totalPrice = $cart->items->sum(fn($item) => (float) $item->product->price * $item->quantity);

            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $address?->id,
                'delivery_method' => $delivery['delivery_method'],
                'status' => 'processing',
                'total_price' => round($totalPrice, 2),
                'contact_first_name' => $contact['first_name'],
                'contact_last_name' => $contact['last_name'],
                'contact_email' => $contact['email'],
                'contact_phone' => $contact['phone'],
            ]);

            foreach ($cart->items as $item) {
                $product = Product::whereKey($item->product_id)->lockForUpdate()->firstOrFail();

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'unit_price' => $product->price,
                ]);

                $product->decrement('stock_quantity', $item->quantity);
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => round($totalPrice, 2),
                'payment_method' => $request->input('payment_method'),
            ]);

            $cart->delete();

            return $order;
        });

        $request->session()->forget(['order_contact', 'order_delivery']);
        return redirect()->route('order.success', $order);
    }

    public function show(Order $order): View
    {
        if ($order->user_id !== null && $order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product.firstImage', 'items.product.brand', 'payment', 'address');
        return view('order.show', compact('order'));
    }

    public function success(Request $request, ?Order $order = null): View|RedirectResponse
    {
        if (!$order) {
            return redirect()->route('home');
        }

        $order->load('items.product', 'payment', 'address');
        return view('order.success', compact('order'));
    }

    private function resolveCart(Request $request): ?Cart
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->first();
        }
        return Cart::where('session_id', $request->session()->getId())->first();
    }
}
