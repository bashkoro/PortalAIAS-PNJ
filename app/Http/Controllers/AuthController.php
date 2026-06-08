<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\HakAkses;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showRegistrationForm()
    {
        $programStudi = ProgramStudi::all();
        return view('auth.register', compact('programStudi'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:pengguna,email',
            'password' => 'required|string|min:8|confirmed',
            'program_studi_id' => 'required|exists:program_studi,id'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'program_studi_id.required' => 'Pilih program studi.',
            'program_studi_id.exists' => 'Program studi tidak valid.'
        ]);

        $hakAkses = HakAkses::where('nama_hak_akses', 'Mahasiswa')->first();

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hak_akses_id' => $hakAkses->id,
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
