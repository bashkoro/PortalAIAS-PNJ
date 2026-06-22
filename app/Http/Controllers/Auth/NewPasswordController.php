<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use App\Models\Pengguna;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    /**
     * Menampilkan halaman reset kata sandi.
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Menangani permintaan kata sandi baru yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        // Di sini kita akan mencoba mereset kata sandi pengguna. Jika berhasil, kita
        // akan memperbarui kata sandi pada model pengguna dan menyimpannya ke
        // database. Jika tidak, kita akan mengurai error dan mengembalikan respons.
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Pengguna $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Jika kata sandi berhasil direset, kita akan mengarahkan pengguna kembali ke
        // halaman utama aplikasi. Jika terjadi error, kita dapat mengarahkan mereka
        // kembali ke halaman sebelumnya beserta pesan error.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
