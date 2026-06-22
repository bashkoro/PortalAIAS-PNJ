<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $programStudi = ProgramStudi::when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('kode_prodi', 'ilike', '%' . $search . '%')
                      ->orWhere('nama_prodi', 'ilike', '%' . $search . '%');
                });
            })
            ->orderBy('nama_prodi')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.program-studi.index', compact('programStudi'));
    }

    /**
     * Menampilkan form untuk membuat sumber daya baru.
     */
    public function create()
    {
        return view('admin.program-studi.create');
    }

    /**
     * Menyimpan sumber daya yang baru dibuat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:20|unique:program_studi,kode_prodi',
            'nama_prodi' => 'required|string|max:100',
        ]);

        ProgramStudi::create($validated);

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit sumber daya yang dipilih.
     */
    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    /**
     * Memperbarui sumber daya yang dipilih.
     */
    public function update(Request $request, ProgramStudi $programStudi)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:20|unique:program_studi,kode_prodi,' . $programStudi->id,
            'nama_prodi' => 'required|string|max:100',
        ]);

        $programStudi->update($validated);

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Menghapus sumber daya yang dipilih dari penyimpanan.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        // Tambahkan pengecekan untuk mencegah penghapusan jika ada model terkait (misalnya Pengguna, MataKuliah)
        if ($programStudi->pengguna()->exists() || $programStudi->mataKuliah()->exists()) {
            return redirect()->route('admin.program-studi.index')->with('error', 'Tidak dapat menghapus Program Studi karena masih digunakan oleh entitas lain.');
        }

        $programStudi->delete();

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
