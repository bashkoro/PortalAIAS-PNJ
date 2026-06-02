<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $aturan = Aturan::getActiveRules();
        return view('admin.aturan.index', compact('aturan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat_aias_id' => 'required|exists:tingkat_aias,id',
            'kondisi' => 'required|array',
        ]);

        $aturanModel = new Aturan();
        
        if ($aturanModel->checkConflict($request->kondisi)) {
            return back()->withErrors(['aturan' => 'Konflik dengan aturan yang sudah ada']);
        }

        if ($aturanModel->saveRule($request->all())) {
            return redirect()->route('admin.aturan.index')->with('success', 'Aturan berhasil disimpan');
        }

        return back()->withErrors(['aturan' => 'Gagal menyimpan aturan']);
    }

    public function destroy(int $id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->is_active = false; // Soft delete based on diagram, or delete() depending on exact requirement
        $aturan->save();
        
        return redirect()->route('admin.aturan.index')->with('success', 'Aturan berhasil dihapus');
    }
}
