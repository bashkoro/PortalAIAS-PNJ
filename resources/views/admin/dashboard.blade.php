@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 mb-6 md:hidden">Dashboard Admin</h2>
    
    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Card: Pengguna -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Pengguna</h3>
                </div>
                <p class="text-4xl font-extrabold text-gray-900">{{ $totalPengguna }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm mt-6 inline-flex items-center transition-colors">
                Kelola Data <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
            </a>
        </div>

        <!-- Card: Program Studi -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Program Studi</h3>
                </div>
                <p class="text-4xl font-extrabold text-gray-900">{{ $totalProgramStudi }}</p>
            </div>
            <a href="{{ route('admin.program-studi.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm mt-6 inline-flex items-center transition-colors">
                Kelola Data <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
            </a>
        </div>

        <!-- Card: Mata Kuliah -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Mata Kuliah</h3>
                </div>
                <p class="text-4xl font-extrabold text-gray-900">{{ $totalMataKuliah }}</p>
            </div>
            <a href="{{ route('admin.mata-kuliah.index') }}" class="text-purple-600 hover:text-purple-800 font-medium text-sm mt-6 inline-flex items-center transition-colors">
                Kelola Data <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
            </a>
        </div>

        <!-- Card: Kelas Kuliah -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Kelas</h3>
                </div>
                <p class="text-4xl font-extrabold text-gray-900">{{ $totalKelasKuliah }}</p>
            </div>
            <a href="{{ route('admin.kelas-kuliah.index') }}" class="text-teal-600 hover:text-teal-800 font-medium text-sm mt-6 inline-flex items-center transition-colors">
                Kelola Data <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
            </a>
        </div>

        <!-- Card: Penugasan -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Penugasan</h3>
                </div>
                <p class="text-4xl font-extrabold text-gray-900">{{ $totalTugas }}</p>
            </div>
            <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm mt-6 inline-flex items-center transition-colors opacity-60 cursor-not-allowed">
                Akan Datang <i class="fas fa-clock ml-1.5 text-xs"></i>
            </a>
        </div>

        <!-- Card: Deklarasi -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Deklarasi</h3>
                </div>
                <p class="text-4xl font-extrabold text-gray-900">{{ $totalDeklarasi }}</p>
            </div>
            <a href="#" class="text-rose-600 hover:text-rose-800 font-medium text-sm mt-6 inline-flex items-center transition-colors opacity-60 cursor-not-allowed">
                Akan Datang <i class="fas fa-clock ml-1.5 text-xs"></i>
            </a>
        </div>

    </div>
    
    <!-- Recent Users Table -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-lg">Pengguna Terbaru</h3>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Kelola Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-6">Nama</th>
                        <th class="py-3 px-6">Email</th>
                        <th class="py-3 px-6 text-center">Program Studi</th>
                        <th class="py-3 px-6 text-center">Hak Akses</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($userTerbaru as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 font-medium text-gray-900">{{ $user->nama }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $user->email }}</td>
                        <td class="py-4 px-6 text-center">{{ $user->programStudi->nama_prodi ?? '-' }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="bg-blue-50 text-blue-700 py-1 px-3 rounded-full text-xs font-bold">{{ $user->hakAkses->nama_hak_akses ?? '-' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 px-6 text-center text-gray-500">Tidak ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
