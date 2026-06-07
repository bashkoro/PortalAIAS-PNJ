@extends('layouts.admin')

@section('title', 'Kelola Program Studi')

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

    <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-white flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Daftar Program Studi</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola data master program studi yang tersedia.</p>
            </div>
            <a href="{{ route('admin.program-studi.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Prodi
            </a>
        </div>

        <!-- Search & Filter Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-col sm:flex-row gap-4 items-end sm:items-center">
                <div class="w-full sm:w-1/2 md:w-1/3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama prodi..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
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
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-6 w-16 text-center">No</th>
                        <th class="py-3 px-6">Kode Prodi</th>
                        <th class="py-3 px-6">Nama Program Studi</th>
                        <th class="py-3 px-6 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($programStudi as $index => $prodi)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-center text-gray-500">{{ $programStudi->firstItem() + $index }}</td>
                        <td class="py-4 px-6 font-medium text-gray-900">
                            <span class="bg-blue-50 text-blue-700 py-1 px-2.5 rounded text-xs font-bold">{{ $prodi->kode_prodi }}</span>
                        </td>
                        <td class="py-4 px-6 text-gray-800">{{ $prodi->nama_prodi }}</td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.program-studi.edit', $prodi->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.program-studi.destroy', $prodi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prodi ini?');">
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
                        <td colspan="4" class="py-8 px-6 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-graduation-cap text-4xl text-gray-300 mb-3"></i>
                                <p>Belum ada data program studi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $programStudi->links() }}
        </div>
    </div>
@endsection
