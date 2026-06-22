<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\HakAkses;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
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

        $hakAkses = HakAkses::orderBy('nama_hak_akses')->get();

        return view('admin.users.index', compact('users', 'hakAkses'));
    }

    public function create()
    {
        $hakAkses = HakAkses::orderBy('nama_hak_akses')->get();
        $programStudi = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin.users.create', compact('hakAkses', 'programStudi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:pengguna,email',
            'password' => 'required|string|min:8|confirmed',
            'hak_akses_id' => 'required|exists:hak_akses,id',
            'program_studi_id' => 'nullable|exists:program_studi,id'
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hak_akses_id' => $request->hak_akses_id,
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(Pengguna $user)
    {
        $hakAkses = HakAkses::orderBy('nama_hak_akses')->get();
        $programStudi = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin.users.edit', compact('user', 'hakAkses', 'programStudi'));
    }

    public function update(Request $request, Pengguna $user)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('pengguna')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'hak_akses_id' => 'required|exists:hak_akses,id',
            'program_studi_id' => 'nullable|exists:program_studi,id'
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'hak_akses_id' => $request->hak_akses_id,
            'program_studi_id' => $request->program_studi_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(Pengguna $user)
    {
        // Proteksi: Jangan hapus jika dosen punya kelas
        if ($user->kelasKuliah()->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal: Dosen masih memiliki kelas kuliah.');
        }

        // Proteksi: Jangan hapus jika mahasiswa punya pendaftaran kelas atau deklarasi
        if ($user->pendaftaranKelas()->exists() || $user->deklarasi()->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal: Mahasiswa memiliki riwayat akademik/deklarasi.');
        }

        // Jangan hapus diri sendiri
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal: Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
