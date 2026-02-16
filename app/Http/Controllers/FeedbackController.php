<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Order::whereNotNull('feedback')->get();
        return view('feedback', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket' => 'required|exists:orders,ticket',
            'feedback' => 'required|string|max:1000',
        ]);

        $order = Order::where('ticket', $request->ticket)->first();

        if ($order) {
            $order->feedback = $request->feedback;
            $order->save();

            return back()->with('success', 'Feedback submitted successfully!');
        }

        return back()->with('error', 'Invalid ticket number.');
    }
}