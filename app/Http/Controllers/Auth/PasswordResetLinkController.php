<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Menampilkan halaman permintaan tautan reset kata sandi.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Menangani permintaan tautan reset kata sandi yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Kita akan mengirimkan tautan reset kata sandi kepada pengguna ini. Setelah mencoba
        // mengirimkan tautan, kita akan memeriksa respons lalu menampilkan pesan yang
        // sesuai kepada pengguna. Terakhir, kita akan mengirimkan respons yang tepat.
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
