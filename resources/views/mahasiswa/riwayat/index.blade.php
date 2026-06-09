@extends('layouts.mahasiswa')

@section('title', 'Riwayat Deklarasi AI')

@section('content')
    <div class="mb-8">
        @if(session('success'))
            <div class="p-4 mb-6 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg flex items-center shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-3"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 mb-6 text-sm font-medium text-emerald-700 bg-emerald-50 border border-indigo-200 rounded-lg flex items-center shadow-sm" role="alert">
                <i class="fas fa-info-circle mr-3"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100/80 bg-white">
                <h3 class="font-extrabold text-gray-900 text-xl tracking-tight">Semua Deklarasi Saya</h3>
                <p class="text-sm text-gray-500 mt-1">Daftar riwayat penggunaan AI yang telah Anda deklarasikan untuk setiap tugas.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white text-left">
                    <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="py-4 px-6 w-16 text-center">No</th>
                            <th class="py-4 px-6">Tugas & Mata Kuliah</th>
                            <th class="py-4 px-6 text-center">Tanggal Deklarasi</th>
                            <th class="py-4 px-6 text-center">Klasifikasi AIAS</th>
                            <th class="py-4 px-6 text-center">Detail Deklarasi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-50">
                        @forelse($riwayat as $index => $item)
                        <tr class="hover:bg-emerald-50/30 transition-all group">
                            <td class="py-5 px-6 text-center text-gray-400 font-mono text-[10px] group-hover:text-indigo-500">{{ $index + 1 }}</td>
                            <td class="py-5 px-6">
                                <div class="font-bold text-gray-900">{{ $item->tugas->judul ?? 'Tugas Tidak Ditemukan' }}</div>
                                <div class="text-[10px] text-gray-400 mt-1 uppercase tracking-tight font-semibold">
                                    {{ $item->tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }}
                                </div>
                            </td>
                            <td class="py-5 px-6 text-center">
                                <div class="text-xs font-medium text-gray-600">{{ $item->waktu_pengumpulan ? $item->waktu_pengumpulan->format('d/m/Y') : '-' }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">{{ $item->waktu_pengumpulan ? $item->waktu_pengumpulan->format('H:i') : '' }} WIB</div>
                            </td>
                            <td class="py-5 px-6 text-center">
                                @if($item->tingkatAias)
                                    @php
                                        $level = $item->tingkatAias->nama_tingkat;
                                        $colorClass = 'bg-gray-100 text-gray-800 border-gray-200';
                                        if (str_contains($level, '1')) $colorClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                        elseif (str_contains($level, '2')) $colorClass = 'bg-emerald-50 text-emerald-700 border-blue-100';
                                        elseif (str_contains($level, '3')) $colorClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                        elseif (str_contains($level, '4')) $colorClass = 'bg-emerald-50 text-emerald-700 border-indigo-100';
                                        elseif (str_contains($level, '5')) $colorClass = 'bg-rose-50 text-rose-700 border-rose-100';
                                    @endphp
                                    <span class="{{ $colorClass }} py-1 px-3 rounded text-[11px] font-bold border uppercase tracking-wide inline-block min-w-[70px]" title="{{ $item->tingkatAias->deskripsi }}">
                                        {{ $level }}
                                    </span>
                                @else
                                    <span class="text-gray-300 italic text-[10px]">Processing...</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-center">
                                <a href="{{ route('mahasiswa.deklarasi.show', $item->id) }}" class="inline-flex items-center px-3 py-1.5 border border-emerald-500 text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 text-xs font-semibold">
                                    <i class="fas fa-eye mr-1.5"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 px-6 text-center text-gray-500 bg-gray-50/50">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 mb-4 text-gray-300">
                                        <i class="fas fa-history text-2xl"></i>
                                    </div>
                                    <p class="text-lg font-bold text-gray-800">Belum ada riwayat deklarasi</p>
                                    <p class="text-sm mt-1">Tugas yang Anda deklarasikan akan muncul di sini.</p>
                                    <a href="{{ route('mahasiswa.dashboard') }}" class="mt-6 px-6 py-2 bg-emerald-600 text-white rounded-xl font-bold text-xs hover:bg-emerald-700 transition-all shadow-lg shadow-indigo-100">
                                        Lihat Tugas Kelas
                                    </a>
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
