<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = DB::table('users')->count();
        $ordersCount = DB::table('orders')->count();
        $menuItemsCount = DB::table('menu_items')->count();

        $ordersByDate = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        $labels = $ordersByDate->pluck('date')->toArray();
        $data = $ordersByDate->pluck('total')->toArray();

        return view('admin.auth.dashboard', compact(
            'usersCount', 'ordersCount', 'menuItemsCount', 'labels', 'data'
        ));
    }
}
