<?php

namespace App\Http\Controllers\Dosen;

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
     * Display a listing of available classes to claim.
     */
    public function available(Request $request)
    {
        $activePeriode = PeriodeAkademik::where('is_active', true)->first();
        
        if (!$activePeriode) {
            return redirect()->route('dosen.dashboard')->with('error', 'Tidak ada periode akademik yang aktif saat ini.');
        }

        $search = $request->query('search');
        $prodiId = $request->query('program_studi_id');

        // Only fetch classes where dosen_id is exactly NULL for the active period
        $kelasTersedia = KelasKuliah::with(['mataKuliah.programStudi'])
            ->where('periode_akademik_id', $activePeriode->id)
            ->whereNull('dosen_id')
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

        return view('dosen.kelas.available', compact('kelasTersedia', 'activePeriode', 'programStudiList'));
    }

    /**
     * Claim a class to teach.
     */
    public function claim(Request $request)
    {
        $request->validate([
            'kelas_kuliah_id' => 'required|exists:kelas_kuliah,id'
        ]);

        $kelas = KelasKuliah::findOrFail($request->kelas_kuliah_id);

        // Security check: ensure class is still unassigned
        if ($kelas->dosen_id) {
            return back()->with('error', 'Kelas ini sudah diampu oleh dosen lain.');
        }

        // Update dosen_id to the current authenticated Dosen
        $kelas->update([
            'dosen_id' => Auth::id()
        ]);

        return redirect()->route('dosen.dashboard')->with('success', "Anda sekarang mengampu kelas {$kelas->nama_kelas} - {$kelas->mataKuliah->nama_mk}.");
    }

    /**
     * Display the specific classroom.
     */
    public function show(KelasKuliah $kelas)
    {
        // Security check: Ensure this dosen actually teaches this class
        if ($kelas->dosen_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke ruang kelas ini.');
        }

        $kelas->load(['mataKuliah.programStudi', 'periodeAkademik']);

        // Fetch all tasks for this specific class
        $tugas = Tugas::with('tingkatAiasAkhir')
            ->where('kelas_kuliah_id', $kelas->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('dosen.kelas.show', compact('kelas', 'tugas'));
    }
}
