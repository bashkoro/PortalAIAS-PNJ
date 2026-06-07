<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $isActive = $request->query('is_active');

        $periodeAkademik = PeriodeAkademik::when($search, function ($query, $search) {
                return $query->where('nama_periode', 'ilike', '%' . $search . '%');
            })
            ->when($isActive !== null, function ($query) use ($isActive) {
                return $query->where('is_active', $isActive);
            })
            ->orderBy('nama_periode', 'desc')
            ->paginate(10)
            ->appends($request->query());

        return view('admin.periode-akademik.index', compact('periodeAkademik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periode-akademik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:100|unique:periode_akademik,nama_periode',
            'is_active' => 'boolean',
        ]);

        $isActive = $request->has('is_active') ? true : false;
        $validated['is_active'] = $isActive;

        DB::transaction(function () use ($validated, $isActive) {
            if ($isActive) {
                // Deactivate all others
                PeriodeAkademik::where('is_active', true)->update(['is_active' => false]);
            }
            PeriodeAkademik::create($validated);
        });

        return redirect()->route('admin.periode-akademik.index')->with('success', 'Periode Akademik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeriodeAkademik $periodeAkademik)
    {
        return view('admin.periode-akademik.edit', compact('periodeAkademik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PeriodeAkademik $periodeAkademik)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:100|unique:periode_akademik,nama_periode,' . $periodeAkademik->id,
            'is_active' => 'boolean',
        ]);

        $isActive = $request->has('is_active') ? true : false;
        $validated['is_active'] = $isActive;

        DB::transaction(function () use ($periodeAkademik, $validated, $isActive) {
            if ($isActive) {
                // Deactivate all others
                PeriodeAkademik::where('id', '!=', $periodeAkademik->id)->update(['is_active' => false]);
            }
            $periodeAkademik->update($validated);
        });

        return redirect()->route('admin.periode-akademik.index')->with('success', 'Periode Akademik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriodeAkademik $periodeAkademik)
    {
        if ($periodeAkademik->kelasKuliah()->exists()) {
            return redirect()->route('admin.periode-akademik.index')->with('error', 'Tidak dapat menghapus Periode Akademik karena masih digunakan oleh Kelas Kuliah.');
        }

        $periodeAkademik->delete();

        return redirect()->route('admin.periode-akademik.index')->with('success', 'Periode Akademik berhasil dihapus.');
    }

    /**
     * Custom method to set a period as active directly from the index.
     */
    public function setActive(PeriodeAkademik $periodeAkademik)
    {
        DB::transaction(function () use ($periodeAkademik) {
            // Deactivate all
            PeriodeAkademik::query()->update(['is_active' => false]);
            // Activate selected
            $periodeAkademik->update(['is_active' => true]);
        });

        return redirect()->route('admin.periode-akademik.index')->with('success', "Periode {$periodeAkademik->nama_periode} telah diaktifkan.");
    }
}
