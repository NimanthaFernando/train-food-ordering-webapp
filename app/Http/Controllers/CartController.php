<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }
    public function add(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $request->name,
            "price" => $request->price,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);
    return redirect()->route('cart')->with('success', 'Item added to cart!');
}

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action === 'increase') {
                $cart[$id]['quantity'] += 1;
            } elseif ($request->action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity'] -= 1;
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }
    public function remove($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item removed from cart!');
}

    public function checkout()
    {
        return view('checkout'); // Create checkout.blade.php
    }
}
