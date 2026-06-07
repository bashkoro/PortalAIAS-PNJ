<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Aturan;
use App\Models\Tugas;
use App\Models\Deklarasi;
use App\Models\ProgramStudi;
use App\Models\MataKuliah;
use App\Models\KelasKuliah;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = Pengguna::count();
        $aturanAktif = Aturan::where('is_active', true)->count();
        $totalTugas = Tugas::count();
        $totalDeklarasi = Deklarasi::count();
        $totalProgramStudi = ProgramStudi::count();
        $totalMataKuliah = MataKuliah::count();
        $totalKelasKuliah = KelasKuliah::count();

        $userTerbaru = Pengguna::with('hakAkses', 'programStudi')->orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPengguna', 
            'aturanAktif', 
            'totalTugas', 
            'totalDeklarasi', 
            'userTerbaru',
            'totalProgramStudi',
            'totalMataKuliah',
            'totalKelasKuliah'
        ));
    }

    public function users(Request $request)
    {
        $search = $request->query('search');
        $hakAksesId = $request->query('hak_akses_id');

        $users = Pengguna::with('hakAkses', 'programStudi')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nama', 'ilike', '%' . $search . '%')
                      ->orWhere('email', 'ilike', '%' . $search . '%');
                });
            })
            ->when($hakAksesId, function ($query, $hakAksesId) {
                return $query->where('hak_akses_id', $hakAksesId);
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->query());

        $hakAkses = \App\Models\HakAkses::orderBy('nama_hak_akses')->get();

        return view('admin.users.index', compact('users', 'hakAkses'));
    }

    public function rules(Request $request)
    {
        $search = $request->query('search');
        $levelId = $request->query('tingkat_aias_id');

        $aturan = Aturan::with(['kondisiAturan', 'tingkatAias'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('kondisiAturan', function($q) use ($search) {
                    $q->where('target_value', 'ilike', '%' . $search . '%');
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
}

