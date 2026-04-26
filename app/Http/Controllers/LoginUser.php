<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUser extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed, redirect to the intended page
            return redirect()->intended('/')->with('success', 'Logged in successfully!');
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors(['email' => 'Invalid credentials. Please try again.'])->withInput();
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
