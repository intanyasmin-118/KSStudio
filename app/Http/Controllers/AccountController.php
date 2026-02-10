<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Show register page
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Customer register
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:account,email',
            'password' => 'required|min:6'
        ]);

        Account::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect('/login')->with('success', 'Account created. Please login.');
    }

    // Show admin register page
    public function showAdminRegisterForm()
    {
        return view('auth.admin-register');
    }

    // Admin register (protected)
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:account,email',
            'password' => 'required|min:6',
            'admin_code' => 'required'
        ]);

        // simple protection
        if ($request->admin_code !== "ADMIN123") {
            return back()->withErrors(['admin_code' => 'Invalid admin code']);
        }

        Account::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        return redirect('/login')->with('success', 'Admin account created. Please login.');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Account::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            session([
                'user_id' => $user->user_id,
                'role' => $user->role
            ]);

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            // CUSTOMER: reset selected package on login
            session()->forget([
                'selected_package_id',
                'selected_package_name',
                'selected_package_price',
                'selected_package_duration'
            ]);

            return redirect('/user/dashboard');
        }

        return back()->withErrors([
            'login' => 'Invalid email or password'
        ]);
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
