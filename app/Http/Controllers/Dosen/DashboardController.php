<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KelasKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the Dosen Dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Fetch classes taught by this dosen
        $kelasDiampu = KelasKuliah::with(['mataKuliah.programStudi', 'periodeAkademik'])
            ->where('dosen_id', $user->id)
            ->get();

        $totalKelas = $kelasDiampu->count();

        return view('dosen.dashboard', compact('kelasDiampu', 'totalKelas'));
    }
}
