<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class ProfileController extends Controller
{
    public function edit()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $user = Account::where('user_id', session('user_id'))->first();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $user = Account::where('user_id', session('user_id'))->first();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:account,email,' . session('user_id') . ',user_id',
        ], [
            'fullname.required' => 'Full name is required',
            'email.required' => 'Email is required',
        ]);


        $user->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
        ]);

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }
}
