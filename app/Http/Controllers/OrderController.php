<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Home/Index
    public function index()
    {
        return view('orders.index'); // optional page
    }

    // Show order by ticket number
    public function showOrder(Request $request)
    {
        $ticket = $request->query('ticket') ?? session('ticket');

        if (!$ticket) {
            return view('track-order')->with('error', 'Please provide your ticket number.');
        }

        $order = Order::where('ticket', $ticket)->first();

        if (!$order) {
            return view('track-order')->with('error', 'Order not found.');
        }

        return view('track-order', compact('order'));
    }

    // Confirm received
    public function confirmReceived(Request $request)
    {
        $ticket = $request->input('ticket');

        $order = Order::where('ticket', $ticket)->first();

        if ($order) {
            $order->order_status = 'Received';
            $order->save();

            return redirect()->route('track-order', ['ticket' => $ticket])
                ->with('success', 'Order confirmed successfully!');
        }

        return redirect()->route('track-order')->with('error', 'Order not found.');
    }

    // Submit feedback
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'ticket' => 'required|string',
            'feedback' => 'required|max:500'
        ]);

        $order = Order::where('ticket', $request->input('ticket'))->first();

        if ($order) {
            $order->feedback = $request->input('feedback');
            $order->save();

            return redirect()->route('track-order', ['ticket' => $request->input('ticket')])
                ->with('feedback_success', 'Thank you for your feedback!');
        }

        return redirect()->route('track-order')->with('error', 'Order not found.');
    }

    // View all feedbacks
    public function showFeedbackPage()
    {
        $feedbacks = Order::whereNotNull('feedback')->latest()->get();
        return view('feedback', compact('feedbacks'));
    }
}
