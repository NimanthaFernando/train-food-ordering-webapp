<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create()
    {
        // Example: Pass ticket_no in session or get from user
        session(['ticket_no' => 'TICKET123']); // example ticket number for demo
        return view('payment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_name'    => 'required|string|max:100',
            'card_number'  => 'required|digits:16',
            'expiry'       => 'required|string',
            'cvv'          => 'required|digits:3',
            'ticket_no'    => 'required'
        ]);

        DB::table('orders')
            ->where('ticket', $request->ticket_no)
            ->update(['payment_status' => 'Success']);

        return response()->json(['message' => 'Payment successful.']);
    }
    public function paymentSuccess(Request $request)
    {
        // Get ticket number from the request (sent from checkout)
        $ticket = $request->input('ticket');

        // Update order status
        $order = Order::where('ticket', $ticket)->first();

        if ($order) {
            $order->order_status = 'Preparing'; // Set as needed
            $order->save();
        }

        // Redirect to track-order page with the ticket as a GET parameter
        return redirect()->route('order.show', ['ticket' => $ticket])
            ->with('success', 'Payment successful! Track your order below.');
    }
}
