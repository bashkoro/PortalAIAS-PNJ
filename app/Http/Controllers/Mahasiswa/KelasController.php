<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KelasKuliah;
use App\Models\PeriodeAkademik;
use App\Models\ProgramStudi;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Menampilkan kelas yang tersedia untuk pendaftaran.
     */
    public function available(Request $request)
    {
        $user = Auth::user();
        $activePeriode = PeriodeAkademik::where('is_active', true)->first();

        if (!$activePeriode) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Tidak ada periode akademik yang aktif saat ini.');
        }

        $search = $request->query('search');
        $prodiId = $request->query('program_studi_id');

        // Mengambil kelas pada periode aktif yang memiliki dosen, dan mahasiswa BELUM terdaftar di dalamnya
        $kelasTersedia = KelasKuliah::with(['mataKuliah.programStudi', 'dosen'])
            ->where('periode_akademik_id', $activePeriode->id)
            ->whereNotNull('dosen_id')
            ->whereDoesntHave('pendaftaranKelas', function($query) use ($user) {
                $query->where('mahasiswa_id', $user->id);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nama_kelas', 'ilike', '%' . $search . '%')
                      ->orWhereHas('mataKuliah', function($mq) use ($search) {
                          $mq->where('nama_mk', 'ilike', '%' . $search . '%');
                      });
                });
            })
            ->when($prodiId, function ($query, $prodiId) {
                return $query->whereHas('mataKuliah', function($mq) use ($prodiId) {
                    $mq->where('program_studi_id', $prodiId);
                });
            })
            ->orderBy('nama_kelas')
            ->paginate(15)
            ->appends($request->query());

        $programStudiList = ProgramStudi::orderBy('nama_prodi')->get();

        return view('mahasiswa.kelas.available', compact('kelasTersedia', 'activePeriode', 'programStudiList'));
    }

    /**
     * Mendaftar ke sebuah kelas.
     */
    public function enroll(Request $request)
    {
        $request->validate([
            'kelas_kuliah_id' => 'required|exists:kelas_kuliah,id'
        ]);

        $user = Auth::user();
        $kelasId = $request->kelas_kuliah_id;

        // Memeriksa apakah sudah terdaftar
        if ($user->kelasKuliah()->where('kelas_kuliah.id', $kelasId)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
        }

        // Menghubungkan mahasiswa ke kelas (tabel pivot: pendaftaran_kelas)
        $user->kelasKuliah()->attach($kelasId);

        $kelas = KelasKuliah::find($kelasId);
        return redirect()->route('mahasiswa.dashboard')->with('success', "Berhasil mendaftar di kelas {$kelas->nama_kelas}.");
    }

    /**
     * Menampilkan ruang kelas spesifik untuk Mahasiswa.
     */
    public function show(KelasKuliah $kelas)
    {
        $user = Auth::user();

        // Pemeriksaan keamanan: Pastikan mahasiswa terdaftar
        if (!$user->kelasKuliah()->where('kelas_kuliah.id', $kelas->id)->exists()) {
            abort(403, 'Anda tidak terdaftar di ruang kelas ini.');
        }

        $kelas->load(['mataKuliah.programStudi', 'dosen', 'periodeAkademik']);

        // Mengambil semua tugas yang dipublikasikan untuk kelas ini
        $tugas = Tugas::with('tingkatAiasAkhir')
            ->where('kelas_kuliah_id', $kelas->id)
            ->where('status_publikasi', 'Published')
            ->orderBy('id', 'desc')
            ->get();

        // Mendapatkan ID tugas yang sudah dideklarasikan oleh mahasiswa
        $declared_tugas_ids = \App\Models\Deklarasi::where('mahasiswa_id', $user->id)
            ->pluck('tugas_id')
            ->toArray();

        return view('mahasiswa.kelas.show', compact('kelas', 'tugas', 'declared_tugas_ids'));
    }
}
