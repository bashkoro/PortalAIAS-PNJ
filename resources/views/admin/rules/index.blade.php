@extends('layouts.admin')

@section('title', 'Rule AIAS')

@section('content')
    <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-white flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Daftar Aturan Klasifikasi</h3>
                <p class="text-sm text-gray-500 mt-1">Seluruh basis aturan Sistem Pakar (Forward Chaining).</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-blue-50 text-blue-700 py-1 px-3 rounded-full text-xs font-bold border border-blue-100">Total: {{ $aturan->total() }} Rules</span>
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
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nilai kriteria (e.g. Mengingat)..." class="block w-full pl-10 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                </div>
                <div class="w-full lg:w-1/4">
                    <select name="tingkat_aias_id" class="block w-full py-2 px-3 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all appearance-none">
                        <option value="">-- Semua Level AIAS --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ request('tingkat_aias_id') == $level->id ? 'selected' : '' }}>{{ $level->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full lg:w-auto">
                    <button type="submit" class="flex-1 lg:flex-none px-6 py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-black transition-colors shadow-sm">
                        Cari
                    </button>
                    <a href="{{ url()->current() }}" class="flex-1 lg:flex-none px-6 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-all text-center">
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
                        <th class="py-4 px-6 w-[60%]">Kondisi (IF)</th>
                        <th class="py-4 px-6 text-center">Hasil (THEN)</th>
                        <th class="py-4 px-6 w-20 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-gray-50">
                    @forelse($aturan as $item)
                    <tr class="hover:bg-blue-50/30 transition-all group">
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
                                elseif (str_contains($levelName, '2')) $colorClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                elseif (str_contains($levelName, '3')) $colorClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                elseif (str_contains($levelName, '4')) $colorClass = 'bg-indigo-50 text-indigo-700 border-indigo-100';
                                elseif (str_contains($levelName, '5')) $colorClass = 'bg-rose-50 text-rose-700 border-rose-100';
                            @endphp
                            <span class="{{ $colorClass }} py-1 px-3 rounded text-[11px] font-bold border uppercase tracking-wide inline-block min-w-[70px]" title="{{ $item->tingkatAias->deskripsi }}">
                                {{ $levelName }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($item->is_active)
                                <span class="flex items-center justify-center h-5 w-5 mx-auto rounded-full bg-emerald-50 text-emerald-500 border border-emerald-100 shadow-sm">
                                    <i class="fas fa-check text-[10px]"></i>
                                </span>
                            @else
                                <span class="flex items-center justify-center h-5 w-5 mx-auto rounded-full bg-gray-50 text-gray-300 border border-gray-100">
                                    <i class="fas fa-times text-[10px]"></i>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 px-6 text-center text-gray-400 bg-gray-50/30">
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
