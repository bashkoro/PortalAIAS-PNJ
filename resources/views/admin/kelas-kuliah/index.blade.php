@extends('layouts.admin')

@section('title', 'Kelola Kelas Kuliah')

@section('content')
    @if(session('success'))
        <div class="mb-6 p-4 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-check-circle mr-3 text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100/80 bg-white flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="font-extrabold text-gray-900 text-xl tracking-tight">Daftar Kelas Kuliah</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola data master kelas kuliah dan penugasan dosen.</p>
            </div>
            <a href="{{ route('admin.kelas-kuliah.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Kelas
            </a>
        </div>

        <!-- Search & Filter Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-end md:items-center">
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kelas..." class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div class="w-full md:w-1/4">
                    <select name="periode_akademik_id" class="block w-full py-2 px-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">-- Semua Periode --</option>
                        @foreach($periodeAkademik as $periode)
                            <option value="{{ $periode->id }}" {{ request('periode_akademik_id') == $periode->id ? 'selected' : '' }}>{{ $periode->nama_periode }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/4">
                    <select name="dosen_id" class="block w-full py-2 px-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">-- Semua Dosen --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->id }}" {{ request('dosen_id') == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl shadow-md shadow-emerald-500/20 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                        Cari
                    </button>
                    <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1 text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left">
                <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-6 w-16 text-center">No</th>
                        <th class="py-3 px-6">Nama Kelas</th>
                        <th class="py-3 px-6">Mata Kuliah</th>
                        <th class="py-3 px-6">Dosen Pengampu</th>
                        <th class="py-3 px-6">Periode</th>
                        <th class="py-3 px-6 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($kelasKuliah as $index => $kelas)
                    <tr class="hover:bg-emerald-50/30 transition-colors group">
                        <td class="py-4 px-6 text-center text-gray-500">{{ $kelasKuliah->firstItem() + $index }}</td>
                        <td class="py-4 px-6 font-medium text-gray-900">
                            <span class="bg-emerald-50 text-emerald-700 py-1 px-2.5 rounded text-xs font-bold">{{ $kelas->nama_kelas }}</span>
                        </td>
                        <td class="py-4 px-6 text-gray-800">{{ $kelas->mataKuliah->nama_mk ?? '-' }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $kelas->dosen->nama ?? '-' }}</td>
                        <td class="py-4 px-6 text-gray-500 text-xs">{{ $kelas->periodeAkademik->nama_periode ?? '-' }}</td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.kelas-kuliah.edit', $kelas->id) }}" class="text-blue-500 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 p-2 rounded transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kelas-kuliah.destroy', $kelas->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded transition-colors" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 px-6 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-4xl text-gray-300 mb-3"></i>
                                <p>Belum ada data kelas kuliah.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $kelasKuliah->links() }}
        </div>
    </div>
@endsection
