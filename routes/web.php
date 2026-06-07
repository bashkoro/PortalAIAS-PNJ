<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeclarationController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password Routes
    Route::get('/forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        // Redirect based on user role (you can adjust this later)
        return redirect('/'); 
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // Protected Routes requiring verified email
    Route::middleware('verified')->group(function () {
        
        // Change Password
        Route::get('/profile/password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/profile/password', [PasswordController::class, 'update'])->name('password.update');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
            Route::get('/rules', [App\Http\Controllers\AdminController::class, 'rules'])->name('rules.index');
            Route::resource('aturan', RuleController::class)->except(['create', 'show', 'edit', 'update']);
        });

        Route::prefix('dosen')->name('dosen.')->group(function () {
            Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
            Route::get('/tugas/create', [TaskController::class, 'create'])->name('tugas.create');
            Route::post('/tugas', [TaskController::class, 'store'])->name('tugas.store');
            Route::get('/tugas/{task}/declarations', [TaskController::class, 'showDeclarations'])->name('tugas.declarations');
            Route::get('/riwayat', [TaskController::class, 'index'])->name('riwayat');
        });

        Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
            Route::get('/dashboard', [App\Http\Controllers\MahasiswaController::class, 'dashboard'])->name('dashboard');
            Route::get('/riwayat', [App\Http\Controllers\MahasiswaController::class, 'riwayat'])->name('riwayat');
            Route::get('/deklarasi', [DeclarationController::class, 'index'])->name('deklarasi.index');
            Route::post('/deklarasi', [DeclarationController::class, 'store'])->name('deklarasi.store');
            Route::get('/deklarasi/{task}', [DeclarationController::class, 'show'])->name('deklarasi.show');
        });
    });
});
