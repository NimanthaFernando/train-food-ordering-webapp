<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashOrder;

class CashOrderController extends Controller
{
    public function index()
    {
        $cashOrders = CashOrder::latest()->get();
        return view('admin.auth.cash-orders', compact('cashOrders'));
    }
}