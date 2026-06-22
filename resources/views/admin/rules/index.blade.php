@extends('layouts.admin')

@section('title', 'Rule AIAS')

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
                <h3 class="font-extrabold text-gray-900 text-xl tracking-tight">Daftar Aturan Klasifikasi</h3>
                <p class="text-sm text-gray-500 mt-1">Seluruh basis aturan Sistem Pakar (Forward Chaining).</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="bg-emerald-50 text-emerald-700 py-1.5 px-3 rounded-xl text-xs font-bold border border-emerald-100">Total: {{ $aturan->total() }} Rules</span>
                <a href="{{ route('admin.rules.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition shadow-sm">
                    <i class="fas fa-plus mr-2"></i> Tambah Aturan
                </a>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-col lg:flex-row gap-4 items-end lg:items-center">
                <div class="w-full lg:w-1/3">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nilai kriteria..." class="block w-full pl-10 pr-3 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                    </div>
                </div>
                <div class="w-full lg:w-1/4">
                    <select name="tingkat_aias_id" class="block w-full py-2.5 px-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all appearance-none">
                        <option value="">-- Semua Level AIAS --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ request('tingkat_aias_id') == $level->id ? 'selected' : '' }}>{{ $level->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full lg:w-auto">
                    <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 bg-emerald-600 text-white rounded-xl shadow-md shadow-emerald-500/20 text-sm font-semibold hover:bg-emerald-700 transition-colors">
                        Cari
                    </button>
                    <a href="{{ url()->current() }}" class="flex-1 lg:flex-none px-6 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left table-fixed">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase font-bold tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6 w-16 text-center">ID</th>
                        <th class="py-4 px-6 w-[55%]">Kondisi (IF)</th>
                        <th class="py-4 px-6 text-center">Hasil (THEN)</th>
                        <th class="py-4 px-6 w-24 text-center">Status</th>
                        <th class="py-4 px-6 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-gray-50">
                    @forelse($aturan as $item)
                    <tr class="hover:bg-emerald-50/30 transition-all group">
                        <td class="py-4 px-6 text-center font-mono text-[10px] text-gray-300 group-hover:text-blue-400">{{ $item->id }}</td>
                        <td class="py-4 px-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->kondisiAturan as $kondisi)
                                    <div class="inline-flex items-center px-2 py-1 rounded border border-gray-100 bg-white shadow-sm transition-all group-hover:border-blue-100">
                                        <span class="text-[9px] font-bold text-gray-400 uppercase mr-1.5">{{ str_replace('_', ' ', $kondisi->nama_parameter) }}:</span>
                                        <span class="text-[11px] font-semibold text-gray-700 @if(request('search') && str_contains(strtolower($kondisi->target_value), strtolower(request('search')))) bg-yellow-100 ring-2 ring-yellow-100 rounded-sm @endif">
                                            {{ $kondisi->target_value }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @php
                                $levelName = $item->tingkatAias->nama_tingkat;
                                $colorClass = 'bg-gray-100 text-gray-800 border-gray-200';
                                if (str_contains($levelName, '1')) $colorClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                elseif (str_contains($levelName, '2')) $colorClass = 'bg-emerald-50 text-emerald-700 border-blue-100';
                                elseif (str_contains($levelName, '3')) $colorClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                elseif (str_contains($levelName, '4')) $colorClass = 'bg-indigo-50 text-indigo-700 border-indigo-100';
                                elseif (str_contains($levelName, '5')) $colorClass = 'bg-rose-50 text-rose-700 border-rose-100';
                            @endphp
                            <span class="{{ $colorClass }} py-1 px-3 rounded text-[11px] font-bold border uppercase tracking-wide inline-block min-w-[70px]">
                                {{ $levelName }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($item->is_active)
                                <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 py-1 px-2 rounded text-[10px] font-bold uppercase">Aktif</span>
                            @else
                                <span class="bg-gray-50 text-gray-400 border border-gray-200 py-1 px-2 rounded text-[10px] font-bold uppercase">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.rules.edit', $item->id) }}" class="text-blue-500 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 p-2 rounded transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.rules.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status aturan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="{{ $item->is_active ? 'text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100' : 'text-emerald-500 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100' }} p-2 rounded transition-colors" title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fas {{ $item->is_active ? 'fa-power-off' : 'fa-check' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 px-6 text-center text-gray-400 bg-gray-50/30">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-search mb-3 text-2xl opacity-20"></i>
                                <p>Tidak ditemukan aturan yang sesuai dengan kriteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-5 border-t border-gray-100 bg-gray-50/30">
            {{ $aturan->links() }}
        </div>
    </div>
@endsection
