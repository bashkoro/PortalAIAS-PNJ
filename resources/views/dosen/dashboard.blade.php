@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')
    <!-- Summary Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-3 rounded-full bg-emerald-50 text-emerald-600 mr-4">
                <i class="fas fa-chalkboard-teacher text-2xl"></i>
            </div>
            <div>
                <p class="mb-1 text-sm font-medium text-gray-500 uppercase tracking-wider">Total Kelas diampu</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalKelas }}</p>
            </div>
        </div>
    </div>

    <!-- Classes Table -->
    <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100/80 bg-white flex justify-between items-center">
            <h3 class="font-extrabold text-gray-900 text-xl tracking-tight">Daftar Kelas yang Anda Ampu</h3>
            <a href="{{ route('dosen.kelas.available') }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium transition-colors">
                <i class="fas fa-plus mr-1"></i> Ambil Kelas Baru
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left">
                <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-6 w-16 text-center">No</th>
                        <th class="py-3 px-6">Nama Kelas</th>
                        <th class="py-3 px-6">Mata Kuliah</th>
                        <th class="py-3 px-6">Program Studi</th>
                        <th class="py-3 px-6 text-center">Periode</th>
                        <th class="py-3 px-6 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($kelasDiampu as $index => $kelas)
                    <tr class="hover:bg-emerald-50/30 transition-colors group">
                        <td class="py-4 px-6 text-center text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-medium text-gray-900">
                            <span class="bg-emerald-50 text-emerald-700 py-1 px-2.5 rounded text-xs font-bold uppercase">{{ $kelas->nama_kelas }}</span>
                        </td>
                        <td class="py-4 px-6 text-gray-800">{{ $kelas->mataKuliah->nama_mk ?? '-' }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $kelas->mataKuliah->programStudi->nama_prodi ?? '-' }}</td>
                        <td class="py-4 px-6 text-center text-xs text-gray-500 font-medium uppercase">{{ $kelas->periodeAkademik->nama_periode ?? '-' }}</td>
                        <td class="py-4 px-6 text-center">
                            <a href="{{ route('dosen.kelas.show', $kelas->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg text-xs font-bold hover:bg-black transition-all shadow-sm">
                                <i class="fas fa-door-open mr-2"></i> Masuk Ruang Kelas
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 px-6 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                                <p class="text-lg font-medium">Anda belum mengampu kelas manapun.</p>
                                <p class="text-sm mt-1">Silakan cari dan ambil kelas yang tersedia.</p>
                                <a href="{{ route('dosen.kelas.available') }}" class="mt-4 px-6 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition-all shadow-md">
                                    Cari Kelas
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
