@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Admin</h2>
        <p class="text-gray-500 mt-2 text-lg">Ringkasan statistik dan aktivitas sistem AIAS PNJ.</p>
    </div>
    
    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        
        <!-- Card: Pengguna -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 border border-gray-100 flex flex-col justify-between hover:shadow-[0_8px_30px_rgb(5,150,105,0.1)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-emerald-500/10 blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-users text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Pengguna</h3>
                </div>
                <p class="text-5xl font-black text-gray-900 tracking-tight">{{ $totalPengguna }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="relative z-10 text-emerald-600 hover:text-emerald-800 font-bold text-sm mt-6 inline-flex items-center transition-colors group-hover:underline decoration-2 underline-offset-4">
                Kelola Data <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <!-- Card: Program Studi -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 border border-gray-100 flex flex-col justify-between hover:shadow-[0_8px_30px_rgb(16,185,129,0.1)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-emerald-500/10 blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Program Studi</h3>
                </div>
                <p class="text-5xl font-black text-gray-900 tracking-tight">{{ $totalProgramStudi }}</p>
            </div>
            <a href="{{ route('admin.program-studi.index') }}" class="relative z-10 text-emerald-600 hover:text-emerald-800 font-bold text-sm mt-6 inline-flex items-center transition-colors group-hover:underline decoration-2 underline-offset-4">
                Kelola Data <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <!-- Card: Mata Kuliah -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 border border-gray-100 flex flex-col justify-between hover:shadow-[0_8px_30px_rgb(5,150,105,0.1)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-teal-500/10 blur-2xl group-hover:bg-teal-500/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-500 to-teal-600 text-white flex items-center justify-center shadow-lg shadow-teal-500/30">
                        <i class="fas fa-book-open text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Mata Kuliah</h3>
                </div>
                <p class="text-5xl font-black text-gray-900 tracking-tight">{{ $totalMataKuliah }}</p>
            </div>
            <a href="{{ route('admin.mata-kuliah.index') }}" class="relative z-10 text-teal-600 hover:text-teal-800 font-bold text-sm mt-6 inline-flex items-center transition-colors group-hover:underline decoration-2 underline-offset-4">
                Kelola Data <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <!-- Card: Kelas Kuliah -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 border border-gray-100 flex flex-col justify-between hover:shadow-[0_8px_30px_rgb(8,145,178,0.1)] hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-cyan-500/10 blur-2xl group-hover:bg-cyan-500/20 transition-all"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 text-white flex items-center justify-center shadow-lg shadow-cyan-500/30">
                        <i class="fas fa-chalkboard-teacher text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Kelas Kuliah</h3>
                </div>
                <p class="text-5xl font-black text-gray-900 tracking-tight">{{ $totalKelasKuliah }}</p>
            </div>
            <a href="{{ route('admin.kelas-kuliah.index') }}" class="relative z-10 text-cyan-600 hover:text-cyan-800 font-bold text-sm mt-6 inline-flex items-center transition-colors group-hover:underline decoration-2 underline-offset-4">
                Kelola Data <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <!-- Card: Penugasan -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all duration-300 relative overflow-hidden">
            <div class="relative z-10 opacity-70">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center">
                        <i class="fas fa-tasks text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Penugasan</h3>
                </div>
                <p class="text-5xl font-black text-gray-400 tracking-tight">{{ $totalTugas }}</p>
            </div>
            <span class="relative z-10 text-gray-400 font-bold text-sm mt-6 inline-flex items-center cursor-not-allowed">
                Akan Datang <i class="fas fa-clock ml-2 text-xs"></i>
            </span>
        </div>

        <!-- Card: Deklarasi -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-all duration-300 relative overflow-hidden">
            <div class="relative z-10 opacity-70">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center">
                        <i class="fas fa-file-signature text-lg"></i>
                    </div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Deklarasi</h3>
                </div>
                <p class="text-5xl font-black text-gray-400 tracking-tight">{{ $totalDeklarasi }}</p>
            </div>
            <span class="relative z-10 text-gray-400 font-bold text-sm mt-6 inline-flex items-center cursor-not-allowed">
                Akan Datang <i class="fas fa-clock ml-2 text-xs"></i>
            </span>
        </div>

    </div>
    
    <!-- Recent Users Table -->
    <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100 overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-100 bg-white flex justify-between items-center">
            <div>
                <h3 class="font-extrabold text-gray-900 text-xl">Pengguna Terbaru</h3>
                <p class="text-sm text-gray-500 mt-1">Pendaftaran akun di sistem</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-bold py-2 px-4 rounded-xl hover:bg-emerald-50 transition-colors inline-flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left">
                <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-8">Pengguna</th>
                        <th class="py-4 px-8 text-center">Program Studi</th>
                        <th class="py-4 px-8 text-center">Hak Akses</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-50">
                    @forelse($userTerbaru as $user)
                    <tr class="hover:bg-emerald-50/30 transition-colors group">
                        <td class="py-4 px-8">
                            <div class="flex items-center gap-4">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-white shadow-sm group-hover:border-emerald-100 transition-colors" src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&color=047857&background=ecfdf5&bold=true" alt="{{ $user->nama }}">
                                <div>
                                    <p class="font-bold text-gray-900">{{ $user->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-8 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $user->programStudi->nama_prodi ?? '-' }}
                            </span>
                        </td>
                        <td class="py-4 px-8 text-center">
                            @if($user->hakAkses && $user->hakAkses->nama_hak_akses == 'Admin')
                                <span class="bg-purple-100 text-purple-800 py-1 px-3 rounded-lg text-xs font-bold uppercase tracking-wide">Admin</span>
                            @elseif($user->hakAkses && $user->hakAkses->nama_hak_akses == 'Dosen')
                                <span class="bg-emerald-100 text-emerald-800 py-1 px-3 rounded-lg text-xs font-bold uppercase tracking-wide">Dosen</span>
                            @else
                                <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-lg text-xs font-bold uppercase tracking-wide">Mahasiswa</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-12 px-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-users-slash text-4xl text-gray-300 mb-3"></i>
                                <p>Tidak ada data pengguna.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection