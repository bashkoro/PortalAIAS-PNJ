<?php

namespace App\Http\Controllers;

use App\Models\Deklarasi;
use App\Models\Tugas;
use App\Models\PendaftaranKelas;
use App\Models\RiwayatPrompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeclarationController extends Controller
{
    public function index()
    {
        $mahasiswaId = Auth::id();
        $kelasIds = PendaftaranKelas::where('mahasiswa_id', $mahasiswaId)->pluck('kelas_kuliah_id');

        $tugas = Tugas::whereIn('kelas_kuliah_id', $kelasIds)
            ->where('status_publikasi', 'Published')
            ->whereDoesntHave('deklarasi', function ($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })
            ->with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])
            ->orderBy('id', 'desc')
            ->get();

        return view('mahasiswa.deklarasi.index', compact('tugas'));
    }

    public function show(int $id)
    {
        $tugas = Tugas::with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])->findOrFail($id);
        return view('mahasiswa.deklarasi.show', compact('tugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'pernyataan_disetujui' => 'required|accepted',
            'bukti_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'nama_platform_ai' => 'nullable|string|max:50',
            'prompt_dikirim' => 'nullable|string',
            'respons_ai' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $deklarasi = new Deklarasi();
            $data = $request->only(['tugas_id']);
            $data['mahasiswa_id'] = Auth::id();
            
            if ($request->hasFile('bukti_file')) {
                $path = $request->file('bukti_file')->store('bukti', 'public');
                $data['path_file_bukti'] = $path;
            }

            if (!$deklarasi->submitDeclaration($data)) {
                throw new \Exception('Gagal menyimpan deklarasi utama.');
            }

            // Save prompt history if provided
            if ($request->filled('prompt_dikirim') || $request->filled('respons_ai') || $request->filled('nama_platform_ai')) {
                $riwayat = new RiwayatPrompt();
                $riwayat->deklarasi_id = $deklarasi->id;
                $riwayat->nama_platform_ai = $request->nama_platform_ai;
                $riwayat->prompt_dikirim = $request->prompt_dikirim;
                $riwayat->respons_ai = $request->respons_ai;
                $riwayat->save();
            }

            DB::commit();
            return redirect()->route('mahasiswa.riwayat')->with('success', 'Deklarasi penggunaan AI berhasil dikirim.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['pernyataan' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}

