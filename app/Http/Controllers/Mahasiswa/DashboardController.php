<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the Mahasiswa Dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Fetch classes this mahasiswa is enrolled in
        $kelasEnrolled = $user->kelasKuliah()->with(['mataKuliah', 'dosen', 'periodeAkademik'])->get();

        $totalKelas = $kelasEnrolled->count();

        return view('mahasiswa.dashboard', compact('kelasEnrolled', 'totalKelas'));
    }
}
