@extends('layouts.mahasiswa')

@section('title', 'Daftar Kelas Baru')

@section('content')
    <div class="mb-6">
        <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Kelas Tersedia - Periode {{ $activePeriode->nama_periode }}</h3>
                <p class="text-sm text-gray-500 mt-1">Cari dan daftar kelas yang ingin Anda ikuti pada semester ini.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-indigo-50 text-indigo-700 py-1 px-3 rounded-full text-xs font-bold border border-indigo-100">
                    {{ $kelasTersedia->total() }} Kelas Ditemukan
                </span>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-end md:items-center">
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kelas atau MK..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <select name="program_studi_id" class="block w-full py-2 px-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Semua Program Studi --</option>
                        @foreach($programStudiList as $prodi)
                            <option value="{{ $prodi->id }}" {{ request('program_studi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1">
                        Cari
                    </button>
                    <a href="{{ route('mahasiswa.kelas.available') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1 text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        @if(session('error'))
            <div class="mx-6 mt-6 p-4 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-6 w-16 text-center">No</th>
                        <th class="py-3 px-6">Nama Kelas</th>
                        <th class="py-3 px-6">Mata Kuliah</th>
                        <th class="py-3 px-6">Dosen</th>
                        <th class="py-3 px-6 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($kelasTersedia as $index => $kelas)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-center text-gray-500">{{ $kelasTersedia->firstItem() + $index }}</td>
                        <td class="py-4 px-6 font-medium text-gray-900 uppercase">{{ $kelas->nama_kelas }}</td>
                        <td class="py-4 px-6 text-gray-800">
                            <div>{{ $kelas->mataKuliah->nama_mk ?? '-' }}</div>
                            <div class="text-[10px] text-gray-400 mt-1 uppercase tracking-tight">{{ $kelas->mataKuliah->programStudi->nama_prodi ?? '-' }}</div>
                        </td>
                        <td class="py-4 px-6 text-gray-600">
                             <div class="flex items-center gap-2">
                                <i class="fas fa-user-tie text-gray-400 text-xs"></i>
                                <span>{{ $kelas->dosen->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('mahasiswa.kelas.enroll') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mendaftar di kelas ini?');">
                                @csrf
                                <input type="hidden" name="kelas_kuliah_id" value="{{ $kelas->id }}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold hover:bg-indigo-700 transition-all shadow-sm">
                                    <i class="fas fa-plus mr-2"></i> Daftar Kelas
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 px-6 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-search text-4xl text-gray-200 mb-3"></i>
                                <p class="text-lg font-medium">Tidak ada kelas yang sesuai.</p>
                                <p class="text-sm mt-1">Silakan coba ubah pencarian atau filter Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $kelasTersedia->links() }}
        </div>
    </div>
@endsection
