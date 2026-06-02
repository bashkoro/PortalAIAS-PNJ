<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Aturan;
use App\Models\Tugas;
use App\Models\Deklarasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = Pengguna::count();
        $aturanAktif = Aturan::where('is_active', true)->count();
        $totalTugas = Tugas::count();
        $totalDeklarasi = Deklarasi::count();

        $userTerbaru = Pengguna::with('hakAkses', 'programStudi')->orderBy('id', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalPengguna', 'aturanAktif', 'totalTugas', 'totalDeklarasi', 'userTerbaru'));
    }

    public function users()
    {
        $users = Pengguna::with('hakAkses', 'programStudi')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function rules()
    {
        $aturan = Aturan::with('kondisiAturan', 'tingkatAias')->orderBy('id', 'desc')->get();
        return view('admin.rules.index', compact('aturan'));
    }
}
