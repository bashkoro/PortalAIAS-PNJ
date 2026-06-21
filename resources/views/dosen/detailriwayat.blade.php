@extends('layouts.dosen')

@section('title', 'Kepatuhan Deklarasi Mahasiswa')

@section('content')
<!-- Header Tugas -->
<div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 mb-6 overflow-hidden">
    <div class="bg-emerald-50 border-b border-emerald-100 p-6">
        <div class="flex justify-between items-start mb-2">
            <span class="text-emerald-700 text-sm font-semibold uppercase tracking-wider">Detail Tugas</span>
            @if($tugas->tingkatAiasAkhir)
                <span class="bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $tugas->tingkatAiasAkhir->nama_tingkat }}</span>
            @endif
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $tugas->judul }}</h2>
        <p class="text-gray-600 text-sm">{{ $tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }} - {{ $tugas->kelasKuliah->nama_kelas ?? '-' }}</p>
    </div>
</div>

<!-- Table Daftar Deklarasi -->
<div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100/80 bg-white flex justify-between items-center">
        <h3 class="font-bold text-gray-800 text-lg">Daftar Deklarasi Masuk</h3>
        <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs font-bold">{{ $deklarasi->count() }} Terkumpul</span>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider">
                <tr>
                    <th class="py-3 px-6 text-center border-b border-gray-200 w-16">No</th>
                    <th class="py-3 px-6 text-left border-b border-gray-200">Nama Mahasiswa</th>
                    <th class="py-3 px-6 text-center border-b border-gray-200">Waktu Pengumpulan</th>
                    <!-- New Column Added Here, Old 'Status Pernyataan' Removed -->
                    <th class="py-3 px-6 text-center border-b border-gray-200">Laporan Deklarasi</th>
                    <th class="py-3 px-6 text-center border-b border-gray-200">Lampiran Bukti</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse($deklarasi as $index => $item)
                <tr class="hover:bg-gray-50 border-b border-gray-100 transition-colors">
                    <td class="py-4 px-6 text-center text-gray-500">{{ $index + 1 }}</td>
                    <td class="py-4 px-6 text-left">
                        <div class="font-medium text-gray-900">{{ $item->mahasiswa->nama ?? '-' }}</div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        {{ $item->waktu_pengumpulan ? \Carbon\Carbon::parse($item->waktu_pengumpulan)->format('d M Y H:i') : '-' }}
                    </td>
                    <!-- Dummy PDF Button Here -->
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('dosen.deklarasi.pdf', $item->id) }}" class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-semibold text-white transition-all bg-emerald-600 rounded-lg hover:bg-emerald-700 shadow-sm hover:shadow focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                            <i class="fas fa-file-pdf text-sm"></i> Unduh PDF
                        </a>
                    </td>
                    <td class="py-4 px-6 text-center">
                        @if($item->path_file_bukti)
                            <a href="{{ asset('storage/' . $item->path_file_bukti) }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 underline flex items-center justify-center gap-1">
                                <i class="fas fa-file-alt"></i> Lihat File
                            </a>
                        @else
                            <span class="text-gray-400 text-xs italic">Tidak ada lampiran</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 px-6 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                            <p>Belum ada mahasiswa yang mengumpulkan deklarasi untuk tugas ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection