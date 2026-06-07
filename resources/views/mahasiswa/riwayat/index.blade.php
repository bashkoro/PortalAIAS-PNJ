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
            <div class="p-4 mb-6 text-sm font-medium text-indigo-700 bg-indigo-50 border border-indigo-200 rounded-lg flex items-center shadow-sm" role="alert">
                <i class="fas fa-info-circle mr-3"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-white">
                <h3 class="font-bold text-gray-900 text-lg">Semua Deklarasi Saya</h3>
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
                            <th class="py-4 px-6 text-center">Bukti</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-50">
                        @forelse($riwayat as $index => $item)
                        <tr class="hover:bg-indigo-50/30 transition-all group">
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
                                        elseif (str_contains($level, '2')) $colorClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                        elseif (str_contains($level, '3')) $colorClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                        elseif (str_contains($level, '4')) $colorClass = 'bg-indigo-50 text-indigo-700 border-indigo-100';
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
                                @if($item->path_file_bukti)
                                    <a href="{{ asset('storage/' . $item->path_file_bukti) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 border border-gray-100 transition-all">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <span class="text-gray-300"><i class="fas fa-minus text-xs"></i></span>
                                @endif
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
                                    <a href="{{ route('mahasiswa.dashboard') }}" class="mt-6 px-6 py-2 bg-indigo-600 text-white rounded-xl font-bold text-xs hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
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
