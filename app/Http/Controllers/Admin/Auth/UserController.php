<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class UserController extends Controller
{
    public function index()
    {
        $users = Customer::all(); // Fetch from customer_login
        return view('admin.auth.users', compact('users'));
    }
}
