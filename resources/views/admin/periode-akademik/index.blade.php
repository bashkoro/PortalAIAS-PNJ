@extends('layouts.admin')

@section('title', 'Kelola Periode Akademik')

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
                <h3 class="font-bold text-gray-900 text-lg">Daftar Periode Akademik</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola data master periode akademik dan status aktifnya.</p>
            </div>
            <a href="{{ route('admin.periode-akademik.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition shadow-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Periode
            </a>
        </div>

        <!-- Search & Filter Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-col sm:flex-row gap-4 items-end sm:items-center">
                <div class="w-full sm:w-1/3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama periode..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="w-full sm:w-1/4">
                    <select name="is_active" class="block w-full py-2 px-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Semua Status --</option>
                        <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
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
                        <th class="py-3 px-6">Nama Periode</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($periodeAkademik as $index => $periode)
                    <tr class="hover:bg-gray-50 transition-colors {{ $periode->is_active ? 'bg-green-50/30' : '' }}">
                        <td class="py-4 px-6 text-center text-gray-500">{{ $periodeAkademik->firstItem() + $index }}</td>
                        <td class="py-4 px-6 font-medium text-gray-900">{{ $periode->nama_periode }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($periode->is_active)
                                <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold inline-flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Aktif
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold inline-flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span> Tidak Aktif
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if(!$periode->is_active)
                                <form action="{{ route('admin.periode-akademik.set-active', $periode->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengaktifkan periode ini? Periode lain akan dinonaktifkan.');">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 px-3 py-1.5 rounded text-xs font-semibold transition-colors" title="Set Aktif">
                                        <i class="fas fa-check mr-1"></i> Set Aktif
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('admin.periode-akademik.edit', $periode->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.periode-akademik.destroy', $periode->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus periode ini?');">
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
                                <i class="fas fa-calendar-alt text-4xl text-gray-300 mb-3"></i>
                                <p>Belum ada data periode akademik.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $periodeAkademik->links() }}
        </div>
    </div>
@endsection
