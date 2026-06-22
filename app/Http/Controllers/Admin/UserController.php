<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $hakAksesId = $request->query('hak_akses_id');

        $users = Pengguna::with('hakAkses', 'programStudi')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
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
}
