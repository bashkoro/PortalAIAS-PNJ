<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $levelId = $request->query('tingkat_aias_id');

        $aturan = Aturan::with(['kondisiAturan', 'tingkatAias'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('kondisiAturan', function($q) use ($search) {
                    $q->where('target_value', 'like', '%' . $search . '%');
                });
            })
            ->when($levelId, function ($query, $levelId) {
                return $query->where('tingkat_aias_id', $levelId);
            })
            ->orderBy('id', 'asc')
            ->paginate(15)
            ->appends($request->query());

        $levels = \App\Models\TingkatAias::orderBy('id')->get();

        return view('admin.rules.index', compact('aturan', 'levels'));
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
            return redirect()->route('admin.rules.index')->with('success', 'Aturan berhasil disimpan');
        }

        return back()->withErrors(['aturan' => 'Gagal menyimpan aturan']);
    }

    public function destroy(int $id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->is_active = false;
        $aturan->save();
        
        return redirect()->route('admin.rules.index')->with('success', 'Aturan berhasil dihapus');
    }
}
