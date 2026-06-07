<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelasKuliah;
use App\Models\MataKuliah;
use App\Models\PeriodeAkademik;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class KelasKuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $periodeId = $request->query('periode_akademik_id');
        $dosenId = $request->query('dosen_id');

        $kelasKuliah = KelasKuliah::with(['mataKuliah', 'dosen', 'periodeAkademik'])
            ->when($search, function ($query, $search) {
                return $query->where('nama_kelas', 'ilike', '%' . $search . '%');
            })
            ->when($periodeId, function ($query, $periodeId) {
                return $query->where('periode_akademik_id', $periodeId);
            })
            ->when($dosenId, function ($query, $dosenId) {
                return $query->where('dosen_id', $dosenId);
            })
            ->orderBy('nama_kelas')
            ->paginate(10)
            ->appends($request->query());

        $periodeAkademik = PeriodeAkademik::orderBy('nama_periode', 'desc')->get();
        $dosen = Pengguna::whereHas('hakAkses', function ($query) {
            $query->where('nama_hak_akses', 'Dosen');
        })->orderBy('nama')->get();

        return view('admin.kelas-kuliah.index', compact('kelasKuliah', 'periodeAkademik', 'dosen'));
    }

    public function create()
    {
        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();
        $periodeAkademik = PeriodeAkademik::where('is_active', true)->get();
        // Fetch users with role 'Dosen'
        $dosen = Pengguna::whereHas('hakAkses', function ($query) {
            $query->where('nama_hak_akses', 'Dosen');
        })->orderBy('nama')->get();

        return view('admin.kelas-kuliah.create', compact('mataKuliah', 'periodeAkademik', 'dosen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:pengguna,id',
            'periode_akademik_id' => 'required|exists:periode_akademik,id',
        ]);

        KelasKuliah::create($validated);

        return redirect()->route('admin.kelas-kuliah.index')->with('success', 'Kelas Kuliah berhasil ditambahkan.');
    }

    public function edit(KelasKuliah $kelasKuliah)
    {
        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();
        $periodeAkademik = PeriodeAkademik::orderBy('nama_periode', 'desc')->get();
        $dosen = Pengguna::whereHas('hakAkses', function ($query) {
            $query->where('nama_hak_akses', 'Dosen');
        })->orderBy('nama')->get();

        return view('admin.kelas-kuliah.edit', compact('kelasKuliah', 'mataKuliah', 'periodeAkademik', 'dosen'));
    }

    public function update(Request $request, KelasKuliah $kelasKuliah)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:pengguna,id',
            'periode_akademik_id' => 'required|exists:periode_akademik,id',
        ]);

        $kelasKuliah->update($validated);

        return redirect()->route('admin.kelas-kuliah.index')->with('success', 'Kelas Kuliah berhasil diperbarui.');
    }

    public function destroy(KelasKuliah $kelasKuliah)
    {
        // Add check if there are related pendaftaran kelas or tugas
        if ($kelasKuliah->pendaftaranKelas()->exists() || $kelasKuliah->tugas()->exists()) {
            return redirect()->route('admin.kelas-kuliah.index')->with('error', 'Tidak dapat menghapus Kelas Kuliah karena masih memiliki mahasiswa atau tugas.');
        }

        $kelasKuliah->delete();

        return redirect()->route('admin.kelas-kuliah.index')->with('success', 'Kelas Kuliah berhasil dihapus.');
    }
}
