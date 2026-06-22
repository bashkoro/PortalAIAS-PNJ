<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard Mahasiswa.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil kelas yang diikuti oleh mahasiswa ini
        $kelasEnrolled = $user->kelasKuliah()->with(['mataKuliah', 'dosen', 'periodeAkademik'])->get();

        $totalKelas = $kelasEnrolled->count();

        return view('mahasiswa.dashboard', compact('kelasEnrolled', 'totalKelas'));
    }
}
