<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $programStudiId = $request->query('program_studi_id');

        $mataKuliah = MataKuliah::with('programStudi')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('kode_mk', 'ilike', '%' . $search . '%')
                      ->orWhere('nama_mk', 'ilike', '%' . $search . '%');
                });
            })
            ->when($programStudiId, function ($query, $programStudiId) {
                return $query->where('program_studi_id', $programStudiId);
            })
            ->orderBy('nama_mk')
            ->paginate(10)
            ->appends($request->query());

        $programStudi = ProgramStudi::orderBy('nama_prodi')->get();

        return view('admin.mata-kuliah.index', compact('mataKuliah', 'programStudi'));
    }

    public function create()
    {
        $programStudi = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin.mata-kuliah.create', compact('programStudi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|string|max:20|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:100',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $programStudi = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin.mata-kuliah.edit', compact('mataKuliah', 'programStudi'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|string|max:20|unique:mata_kuliah,kode_mk,' . $mataKuliah->id,
            'nama_mk' => 'required|string|max:100',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        if ($mataKuliah->kelasKuliah()->exists()) {
            return redirect()->route('admin.mata-kuliah.index')->with('error', 'Tidak dapat menghapus Mata Kuliah karena masih digunakan oleh Kelas Kuliah.');
        }

        $mataKuliah->delete();

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
