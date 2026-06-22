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
     * Menampilkan formulir untuk membuat deklarasi baru.
     */
    public function create(Request $request)
    {
        $tugasId = $request->query('tugas_id');
        $user = Auth::user();

        if (!$tugasId) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Pilih tugas terlebih dahulu.');
        }

        // Mengambil tugas dan memastikan mahasiswa terdaftar di kelas tersebut
        $tugas = Tugas::with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])
            ->whereHas('kelasKuliah.pendaftaranKelas', function($query) use ($user) {
                $query->where('mahasiswa_id', $user->id);
            })
            ->findOrFail($tugasId);

        // Memeriksa apakah sudah melakukan deklarasi
        $existing = Deklarasi::where('tugas_id', $tugasId)
            ->where('mahasiswa_id', $user->id)
            ->first();

        if ($existing) {
            return redirect()->route('mahasiswa.riwayat')->with('info', 'Anda sudah mengirimkan deklarasi untuk tugas ini.');
        }

        return view('mahasiswa.deklarasi.create', compact('tugas'));
    }

    /**
     * Menyimpan deklarasi yang baru dibuat ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'pernyataan_disetujui' => 'required|accepted',
            'nama_platform_ai' => 'required|string|max:50',
            'prompt_dikirim' => 'required|string',
            'respons_ai' => 'required|string',
            'link_conversation' => 'nullable|url',
            'bukti_file' => 'nullable|file|mimes:pdf,jpg,png|max:5120'
        ], [
            'pernyataan_disetujui.accepted' => 'Anda harus menyetujui pernyataan integritas akademik.',
            'nama_platform_ai.required' => 'Platform AI wajib diisi.',
            'prompt_dikirim.required' => 'Prompt yang dikirim wajib diisi.',
            'respons_ai.required' => 'Ringkasan respons AI wajib diisi.'
        ]);

        $user = Auth::user();
        $tugas = Tugas::findOrFail($request->tugas_id);

        // Pemeriksaan keamanan
        $isEnrolled = $user->kelasKuliah()->where('kelas_kuliah.id', $tugas->kelas_kuliah_id)->exists();
        if (!$isEnrolled) {
            abort(403, 'Anda tidak terdaftar di kelas untuk tugas ini.');
        }

        $path = null;
        if ($request->hasFile('bukti_file')) {
            $path = $request->file('bukti_file')->store('bukti_deklarasi', 'public');
        }

        // TODO: Eksekusi logika Forward Chaining di sini untuk menentukan Level AIAS
        $detectedLevelId = $tugas->tingkat_aias_akhir_id; 

        $deklarasi = Deklarasi::create([
            'tugas_id' => $tugas->id,
            'mahasiswa_id' => $user->id,
            'pernyataan_disetujui' => true,
            'path_file_bukti' => $path,
            'tingkat_aias_id' => $detectedLevelId,
            'waktu_pengumpulan' => now()
        ]);

        $deklarasi->riwayatPrompt()->create([
            'nama_platform_ai' => $request->nama_platform_ai,
            'prompt_dikirim' => $request->prompt_dikirim,
            'respons_ai' => $request->respons_ai,
            'link_conversation' => $request->link_conversation,
        ]);

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Deklarasi AI berhasil dikirim.');
    }

    /**
     * Menampilkan deklarasi yang spesifik.
     */
    public function show($id)
    {
        $deklarasi = Deklarasi::with(['tugas.tingkatAiasAkhir', 'tingkatAias', 'riwayatPrompt'])
            ->where('id', $id)
            ->where('mahasiswa_id', Auth::id())
            ->firstOrFail();

        return view('mahasiswa.deklarasi.show', compact('deklarasi'));
    }
}
