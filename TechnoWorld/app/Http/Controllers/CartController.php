<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $this->resolveCart($request);
        $cart?->load('items.product.brand', 'items.product.firstImage');

        $itemCount = $cart ? $cart->items->sum('quantity') : 0;
        $subtotal = $cart ? $cart->items->sum(fn($item) => (float) $item->product->price * $item->quantity) : 0;
        return view('cart', compact('cart', 'itemCount', 'subtotal'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|uuid|exists:products,id',
            'quantity' => 'integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        if ($product->stock_quantity <= 0) {
            return back()->withErrors(['stock' => 'This product is out of stock.']);
        }

        $cart = $this->resolveOrCreateCart($request);
        $item = $cart->items()->where('product_id', $product->id)->first();
        $qty = $request->integer('quantity', 1);

        if ($item) {
            $item->update([
                'quantity' => min($item->quantity + $qty, $product->stock_quantity),
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => min($qty, $product->stock_quantity),
                'added_at' => now(),
            ]);
        }
        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $item): RedirectResponse
    {
        $cart = $this->resolveCart($request);
        if (!$cart || $item->cart_id !== $cart->id) {
            abort(400);
        }

        $request->validate(['quantity' => 'required|integer|min:0']);
        $quantity = $request->integer('quantity');

        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->update([
                'quantity' => min($quantity, $item->product->stock_quantity),
            ]);
        }
        return redirect()->route('cart.index');
    }

    public function remove(Request $request, CartItem $item): RedirectResponse
    {
        $cart = $this->resolveCart($request);
        if (!$cart || $item->cart_id !== $cart->id) {
            abort(400);
        }

        $item->delete();
        return redirect()->route('cart.index');
    }

    private function resolveCart(Request $request): ?Cart
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->first();
        }
        return Cart::where('session_id', $request->session()->getId())->first();
    }

    private function resolveOrCreateCart(Request $request): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => null]
            );
        }

        $sessionId = $request->session()->getId();
        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['user_id' => null]
        );
    }
}
