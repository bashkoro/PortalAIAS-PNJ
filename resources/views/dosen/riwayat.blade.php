@extends('layouts.dosen')

@section('title', 'Riwayat Penugasan')

@section('content')
    <div class="mb-8">
        @if(session('success'))
            <div class="p-4 mb-6 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg flex items-center shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100/80 bg-white flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-gray-900 text-xl tracking-tight">Daftar Semua Penugasan</h3>
                    <p class="text-sm text-gray-500 mt-1">Seluruh riwayat tugas yang telah Anda buat dan klasifikasi.</p>
                </div>
                <a href="{{ route('dosen.tugas.create') }}" class="inline-flex items-center px-6 py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-sm hover:bg-emerald-700 transition-all shadow-lg shadow-blue-100">
                    <i class="fas fa-plus mr-2"></i> Tugas Baru
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white text-left">
                    <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="py-3 px-6 w-16 text-center">No</th>
                            <th class="py-3 px-6">Judul Tugas</th>
                            <th class="py-3 px-6">Mata Kuliah / Kelas</th>
                            <th class="py-3 px-6 text-center">Hasil AI Score</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                        @forelse($tugas as $index => $item)
                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                            <td class="py-4 px-6 text-center text-gray-500 font-mono text-xs">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-900 truncate max-w-xs">{{ $item->judul }}</div>
                                <div class="text-[11px] text-gray-500 mt-1 line-clamp-1 italic">{{ $item->deskripsi }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-medium text-gray-800">{{ $item->kelasKuliah->mataKuliah->nama_mk ?? '-' }}</div>
                                <div class="inline-flex items-center px-2 py-0.5 mt-1 rounded bg-slate-100 text-slate-600 text-[10px] font-bold uppercase tracking-wider">
                                    Kelas {{ $item->kelasKuliah->nama_kelas ?? '-' }}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($item->tingkatAiasAkhir)
                                    @php
                                        $level = $item->tingkatAiasAkhir->nama_tingkat;
                                        $colorClass = 'bg-gray-100 text-gray-800';
                                        if (str_contains($level, '1')) $colorClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                        elseif (str_contains($level, '2')) $colorClass = 'bg-emerald-50 text-emerald-700 border-blue-100';
                                        elseif (str_contains($level, '3')) $colorClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                        elseif (str_contains($level, '4')) $colorClass = 'bg-emerald-50 text-emerald-700 border-indigo-100';
                                        elseif (str_contains($level, '5')) $colorClass = 'bg-rose-50 text-rose-700 border-rose-100';
                                    @endphp
                                    <span class="{{ $colorClass }} py-1 px-3 rounded text-[11px] font-bold border uppercase tracking-wide inline-block min-w-[70px]" title="{{ $item->tingkatAiasAkhir->deskripsi }}">
                                        {{ $level }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-xs">Belum Diklasifikasi</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if(strtolower($item->status_publikasi) === 'published')
                                    <span class="inline-flex items-center text-emerald-600 font-bold text-xs uppercase tracking-tighter">
                                        <i class="fas fa-check-circle mr-1.5"></i> Terbit
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-gray-400 font-bold text-xs uppercase tracking-tighter">
                                        <i class="fas fa-file-alt mr-1.5"></i> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('dosen.tugas.declarations', $item->id) }}" class="inline-flex items-center justify-center bg-gray-900 hover:bg-black text-white text-[11px] font-bold py-2 px-4 rounded-lg shadow-sm transition-all">
                                    <i class="fas fa-search mr-2 opacity-70"></i> Lihat Deklarasi
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-16 px-6 text-center text-gray-500 bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 mb-4 text-gray-300">
                                        <i class="fas fa-folder-open text-2xl"></i>
                                    </div>
                                    <p class="text-lg font-bold text-gray-800">Belum ada penugasan</p>
                                    <p class="text-sm mt-1">Mulai dengan membuat tugas pertama Anda di tombol kanan atas.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
