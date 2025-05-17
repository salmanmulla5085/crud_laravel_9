<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => false,
            'password' => Hash::make($request->password)
        ]);

        session(['user' => $user]);
        return redirect($user->is_admin ? route('admin.dashboard') : route('user.dashboard'));
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {

        //serverside validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect($user->is_admin ? route('admin.dashboard') : route('user.dashboard'));
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('login');
    }
}

