<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Deklarasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Display a listing of declarations history.
     */
    public function index()
    {
        $user = Auth::user();

        $riwayat = Deklarasi::with(['tugas.kelasKuliah.mataKuliah', 'tingkatAias'])
            ->where('mahasiswa_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('mahasiswa.riwayat.index', compact('riwayat'));
    }
}
