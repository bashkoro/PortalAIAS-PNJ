<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\Aturan;
use App\Models\Tugas;
use App\Models\Deklarasi;
use App\Models\ProgramStudi;
use App\Models\MataKuliah;
use App\Models\KelasKuliah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengguna = Pengguna::count();
        $aturanAktif = Aturan::where('is_active', true)->count();
        $totalTugas = Tugas::count();
        $totalDeklarasi = Deklarasi::count();
        $totalProgramStudi = ProgramStudi::count();
        $totalMataKuliah = MataKuliah::count();
        $totalKelasKuliah = KelasKuliah::count();

        $userTerbaru = Pengguna::with('hakAkses', 'programStudi')->orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPengguna', 
            'aturanAktif', 
            'totalTugas', 
            'totalDeklarasi', 
            'userTerbaru',
            'totalProgramStudi',
            'totalMataKuliah',
            'totalKelasKuliah'
        ));
    }
}
