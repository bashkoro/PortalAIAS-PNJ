<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Deklarasi;
use App\Models\TingkatAias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeklarasiController extends Controller
{
    /**
     * Show the form for creating a new declaration.
     */
    public function create(Request $request)
    {
        $tugasId = $request->query('tugas_id');
        $user = Auth::user();

        if (!$tugasId) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Pilih tugas terlebih dahulu.');
        }

        // Fetch task and ensure student is enrolled in the class
        $tugas = Tugas::with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])
            ->whereHas('kelasKuliah.pendaftaranKelas', function($query) use ($user) {
                $query->where('mahasiswa_id', $user->id);
            })
            ->findOrFail($tugasId);

        // Check if already declared
        $existing = Deklarasi::where('tugas_id', $tugasId)
            ->where('mahasiswa_id', $user->id)
            ->first();

        if ($existing) {
            return redirect()->route('mahasiswa.riwayat')->with('info', 'Anda sudah mengirimkan deklarasi untuk tugas ini.');
        }

        // AID Framework Aspects
        $daftar_kondisi = [
            'Conceptualization' => 'AI membantu memunculkan ide/topik awal.',
            'Methodology' => 'AI menyusun langkah kerja atau struktur tugas.',
            'Info Collection' => 'AI mencari referensi atau meringkas bacaan.',
            'Data Collection' => 'AI membuat form/kuesioner sederhana.',
            'Execution' => 'AI menyusun draft atau outline tugas.',
            'Data Curation' => 'AI menyusun tabel atau data hasil observasi.',
            'Data Analysis' => 'AI membaca grafik atau menjelaskan data dasar.',
            'Interpretation' => 'AI membantu menyimpulkan atau merangkum poin penting.',
            'Visualization' => 'AI membuat infografis, bagan, atau diagram.',
            'Writing - Editing' => 'AI koreksi tata bahasa atau struktur kalimat.',
            'Writing - Translation' => 'AI digunakan untuk menerjemahkan isi tugas.',
            'Project Management' => 'AI membantu menjadwalkan atau membagi tugas kelompok.'
        ];

        return view('mahasiswa.deklarasi.create', compact('tugas', 'daftar_kondisi'));
    }

    /**
     * Store a newly created declaration in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'pernyataan_disetujui' => 'required|accepted',
            'kondisi_penggunaan' => 'required|array|min:1',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ], [
            'pernyataan_disetujui.accepted' => 'Anda harus menyetujui pernyataan integritas akademik.',
            'kondisi_penggunaan.required' => 'Pilih setidaknya satu aspek penggunaan AI.',
            'kondisi_penggunaan.min' => 'Pilih setidaknya satu aspek penggunaan AI.'
        ]);

        $user = Auth::user();
        $tugas = Tugas::findOrFail($request->tugas_id);

        // Security check
        $isEnrolled = $user->kelasKuliah()->where('kelas_kuliah.id', $tugas->kelas_kuliah_id)->exists();
        if (!$isEnrolled) {
            abort(403, 'Anda tidak terdaftar di kelas untuk tugas ini.');
        }

        $path = null;
        if ($request->hasFile('bukti_file')) {
            $path = $request->file('bukti_file')->store('bukti_deklarasi', 'public');
        }

        // TODO: Execute Forward Chaining logic here to determine AIAS Level
        $detectedLevelId = $tugas->tingkat_aias_akhir_id; 

        $deklarasi = Deklarasi::create([
            'tugas_id' => $tugas->id,
            'mahasiswa_id' => $user->id,
            'pernyataan_disetujui' => true,
            'path_file_bukti' => $path,
            'tingkat_aias_id' => $detectedLevelId,
            'waktu_pengumpulan' => now()
        ]);

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Deklarasi AI berhasil dikirim dan telah diklasifikasi.');
    }

    /**
     * Display the specified declaration.
     */
    public function show($id)
    {
        $deklarasi = Deklarasi::with(['tugas.tingkatAiasAkhir', 'tingkatAias'])
            ->where('id', $id)
            ->where('mahasiswa_id', Auth::id())
            ->firstOrFail();

        return view('mahasiswa.deklarasi.show', compact('deklarasi'));
    }
}
