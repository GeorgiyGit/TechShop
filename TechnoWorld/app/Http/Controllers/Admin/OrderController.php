<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private const STATUSES = ['processing', 'shipped', 'delivered', 'cancelled'];

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::with(['user', 'payment', 'items'])
            ->when($search, fn($q) => $q->where('id', 'ILIKE', "%{$search}%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $statuses = self::STATUSES;
        return view('admin.orders.index', compact('orders', 'statuses', 'search', 'status'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'address', 'payment', 'items.product.brand']);
        return view('admin.orders.show', compact('order'));
    }

    public function editStatus(Order $order)
    {
        $order->load(['user', 'items']);
        $statuses = self::STATUSES;
        return view('admin.orders.status', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', self::STATUSES),
        ]);

        $order->update(['status' => $request->input('status')]);
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated.');
    }
}
