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
        $cart?->load('items.product.firstImage');
        return view('cart', compact('cart'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $product = Product::where('is_active', true)
            ->where('stock_left', '>', 0)
            ->findOrFail($request->input('product_id'));

        $product->increment('popularity_score', 20);

        $cart = $this->resolveOrCreateCart($request);
        $item = $cart->items()->where('product_id', $product->id)->first();
        if ($item) {
            $item->update([
                'quantity' => min($item->quantity + ($request->integer('quantity', 1)), $product->stock_left),
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => min($request->integer('quantity', 1), $product->stock_left),
                'added_at' => now(),
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $item): RedirectResponse
    {
        $cart = $this->resolveCart($request);
        if (! $cart || $item->cart_id !== $cart->id) {
            abort(400);
        }

        $quantity = $request->integer('quantity', 1);
        $quantity = max(1, min($quantity, $item->product->stock_left));

        $item->update(['quantity' => $quantity]);

        return redirect()->route('cart.index');
    }

    public function remove(Request $request, CartItem $item): RedirectResponse
    {
        $cart = $this->resolveCart($request);
        if (! $cart || $item->cart_id !== $cart->id) {
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

        $sessionId = $request->session()->getId();

        return Cart::where('session_id', $sessionId)->first();
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
