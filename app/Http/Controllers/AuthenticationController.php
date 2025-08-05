<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'ADMIN') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'STUDENT') {
                return redirect()->intended('/student/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Role is not valid.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Wrong credentials',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
