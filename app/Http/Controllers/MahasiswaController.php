<?php

namespace App\Http\Controllers;

use App\Models\Deklarasi;
use App\Models\Tugas;
use App\Models\PendaftaranKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $mahasiswaId = $user->id;

        // Mendapatkan kelas yang diikuti
        $kelasIds = PendaftaranKelas::where('mahasiswa_id', $mahasiswaId)->pluck('kelas_kuliah_id');

        // Mendapatkan jumlah kelas aktif
        $kelasAktif = $kelasIds->count();

        // Mendapatkan jumlah deklarasi yang telah selesai
        $deklarasiSelesai = Deklarasi::where('mahasiswa_id', $mahasiswaId)->count();

        // Mendapatkan semua tugas dari kelas yang diikuti oleh mahasiswa, 
        // DI MANA mahasiswa belum mengirimkan deklarasi.
        $tugasMenunggu = \App\Models\Tugas::whereHas('kelasKuliah.mahasiswa', function ($query) use ($user) {
            $query->where('pengguna.id', $user->id);
        })->whereDoesntHave('deklarasi', function ($query) use ($user) {
            $query->where('mahasiswa_id', $user->id);
        })->get();

        $tugasMenungguCount = $tugasMenunggu->count();

        return view('mahasiswa.dashboard', compact('tugasMenunggu', 'tugasMenungguCount', 'deklarasiSelesai', 'kelasAktif'));
    }

    public function riwayat()
    {
        $mahasiswaId = Auth::id();
        
        $deklarasi = Deklarasi::with(['tugas.kelasKuliah.mataKuliah', 'tugas.tingkatAiasAkhir', 'riwayatPrompt'])
            ->where('mahasiswa_id', $mahasiswaId)
            ->orderBy('waktu_pengumpulan', 'desc')
            ->get();

        return view('mahasiswa.riwayat', compact('deklarasi'));
    }
}
