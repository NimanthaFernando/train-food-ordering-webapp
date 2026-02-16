<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        if ($category && $category !== 'All') {
            $menuItems = MenuItem::where('category', $category)->get();
        } else {
            $menuItems = MenuItem::all();
        }

        $categories = MenuItem::select('category')->distinct()->pluck('category')->toArray();
        array_unshift($categories, 'All');

        return view('admin.auth.menu', compact('menuItems', 'categories', 'category'));
    }

    public function toggleAvailability(MenuItem $item)
    {
        $item->available = !$item->available;
        $item->save();

        return redirect()->back()->with('status', 'Availability updated!');
    }
}