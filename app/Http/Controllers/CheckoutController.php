<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page with cart items.
     */
    public function index()
    {
        $cartItems = session('cart', []);
        return view('checkout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'ticket' => 'required|string',
            'phone' => 'required|string',
            'seat' => 'required|string',
            'train_class' => 'required|string',
            'class_name' => 'required|string',
        ]);

        $cartItems = session('cart', []);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = new Order();
        $order->name = $validated['name'];
        $order->ticket = $validated['ticket'];
        $order->phone = $validated['phone'];
        $order->seat = $validated['seat'];
        $order->train_class = $request->train_class;
        $order->class_name = $request->class_name;
        $order->items = json_encode($cartItems); // Save all cart items
        $order->total = $total;
        $order->save();

        // Clear cart after placing order
        session()->forget('cart');

          return redirect()->route('payment.create')->with('success', 'Order placed successfully! Proceed to payment.');
    }
}
