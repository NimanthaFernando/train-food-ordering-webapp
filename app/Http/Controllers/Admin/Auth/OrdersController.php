<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MenuItem;

class OrdersController extends Controller
{
 public function index()
{
    $orders = Order::all();
    $cashOrders = Order::where('payment_status', 'cash')->get();

    $menuItems = MenuItem::all(); // Fetch all menu items

    return view('admin.auth.orders', compact('orders', 'cashOrders', 'menuItems'));
}

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:Pending,Preparing,Delivering,Cancelled',
        ]);

        $order->order_status = $request->order_status;
        $order->save();

        return back()->with('success', 'Order status updated successfully.');
    }

    public function feedback()
    {
        $orders = Order::whereNotNull('feedback')->latest()->get();
        return view('admin.auth.feedback', compact('orders'));
    }

    // ✅ New Method: Called when customer clicks "Confirm Received"
    public function confirmReceived(Request $request)
    {
        $request->validate([
            'ticket' => 'required'
        ]);

        $order = Order::where('ticket', $request->ticket)->first();

        if ($order) {
            $order->order_status = 'Received';
            $order->save();
            return back()->with('success', 'Order marked as received.');
        }

        return back()->with('error', 'Order not found.');
    }
public function weeklyReportView()
{
    $oneWeekAgo = \Carbon\Carbon::now()->subWeek();

    $orders = \App\Models\Order::where('created_at', '>=', $oneWeekAgo)
        ->orderBy('created_at', 'desc')
        ->get();

    foreach ($orders as $order) {
        $order->items = json_decode($order->items, true);
    }

    return view('admin.auth.weekly-report', compact('orders'));
}


public function storeCashOrderMulti(Request $request)
{
    $request->validate([
        'items_json' => 'required|string',
    ]);

    $items = json_decode($request->items_json, true);

    if (!$items || !is_array($items) || count($items) == 0) {
        return redirect()->back()->with('error', 'Please add at least one item.');
    }

    $total = 0;
    foreach ($items as $item) {
        if (!isset($item['price'], $item['quantity'])) {
            return redirect()->back()->with('error', 'Invalid item data.');
        }
        $total += $item['price'] * $item['quantity'];
    }

    $order = new Order();

    // Only assign these fields — do NOT assign seat_no, train_class, ticket, phone, email here
    $order->name = 'Cash Order';
    $order->items = json_encode($items);
    $order->total = $total;
    $order->payment_status = 'cash';
    $order->order_status = 'Pending';

    $order->save();

    return redirect()->route('admin..auth.orders')->with('success', 'Cash order added successfully!');
}

}
