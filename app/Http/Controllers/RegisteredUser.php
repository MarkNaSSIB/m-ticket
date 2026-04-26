<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisteredUser extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'repassword' => ['required', 'string', 'same:password'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => ($request->password), // bcrypt
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully!');
    }
}
