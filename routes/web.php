<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeclarationController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Public Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
        Route::get('/rules', [App\Http\Controllers\AdminController::class, 'rules'])->name('rules.index');
        Route::resource('aturan', RuleController::class)->except(['create', 'show', 'edit', 'update']);
    });

    // Dosen Routes
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
        Route::get('/tugas/create', [TaskController::class, 'create'])->name('tugas.create');
        Route::post('/tugas', [TaskController::class, 'store'])->name('tugas.store');
        Route::get('/tugas/{task}/declarations', [TaskController::class, 'showDeclarations'])->name('tugas.declarations');
        Route::get('/riwayat', [TaskController::class, 'index'])->name('riwayat');
    });

    // Mahasiswa Routes
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/riwayat', [App\Http\Controllers\MahasiswaController::class, 'riwayat'])->name('riwayat');
        Route::get('/deklarasi', [DeclarationController::class, 'index'])->name('deklarasi.index');
        Route::post('/deklarasi', [DeclarationController::class, 'store'])->name('deklarasi.store');
        Route::get('/deklarasi/{task}', [DeclarationController::class, 'show'])->name('deklarasi.show');
    });
});
