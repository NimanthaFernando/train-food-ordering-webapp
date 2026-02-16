<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem; // ✅ IMPORT this!
use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category'); // e.g., "Buns"

        if ($category && $category !== 'All') {
            $menuItems = MenuItem::where('category', $category)->get();
        } else {
            $menuItems = MenuItem::all();
        }

        // Optional: You can fetch distinct category list from DB
        $categories = MenuItem::select('category')->distinct()->pluck('category')->toArray();

        array_unshift($categories, 'All'); // Add "All" to the front

        return view('menu', compact('menuItems', 'categories', 'category'));
    }

    /*public function showMenu(){
    $categories = Category::all();
    $foodItems = FoodItem::where('category_id', $id)->get();

    return view('menu', compact('categories', 'foodItems'));
    }

public function userView() {
    $items = FoodItem::all();
    return view('menu', compact('items'));
}
*/

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name . ' added to cart!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeFromCart($name)
    {
        $cart = session()->get('cart', []);
        unset($cart[$name]);
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Item removed!');
    }
}
