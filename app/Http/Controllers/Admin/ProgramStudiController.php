<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-studi.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        // Add a check to prevent deletion if there are related models (e.g., Pengguna, MataKuliah)
        if ($programStudi->pengguna()->exists() || $programStudi->mataKuliah()->exists()) {
            return redirect()->route('admin.program-studi.index')->with('error', 'Tidak dapat menghapus Program Studi karena masih digunakan oleh entitas lain.');
        }

        $programStudi->delete();

        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
