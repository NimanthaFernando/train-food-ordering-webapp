<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Prevent admin login from this form
        if (Admin::where('email', $credentials['email'])->exists()) {
            return back()->withErrors([
                'email' => 'This account is not allowed to login from here.',
            ])->onlyInput('email');
        }

        // Attempt to login user
        \Illuminate\Support\Facades\Log::info('Login attempt', ['email' => $credentials['email']]);

        if (Auth::guard('web')->attempt($credentials)) {
            \Illuminate\Support\Facades\Log::info('Login successful');
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        \Illuminate\Support\Facades\Log::error('Login failed for email: ' . $credentials['email']);

        // If login fails
        return back()->withErrors([
            'email' => 'Invalid credentials!',
        ])->onlyInput('email');    }

    public function showSignupForm()
    {
        return view('signup'); // signup.blade.php
    }

    public function signup(Request $request)    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->route('signup')->with("error", "Registration failed");
        }

        return redirect()->route('login')->with("success", "Registration successful! Please login.");
    }



}