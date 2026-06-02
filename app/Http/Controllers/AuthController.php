<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            if ($user->checkRole('Admin')) {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->checkRole('Dosen')) {
                return redirect()->intended('dosen/dashboard');
            } else {
                return redirect()->intended('mahasiswa/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Kredensial Salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
