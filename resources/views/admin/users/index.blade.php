@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
    @if(session('success'))
        <div class="mb-6 p-4 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg flex items-center shadow-sm">
            <i class="fas fa-check-circle mr-3 text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-white flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Daftar Pengguna</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola data seluruh pengguna sistem.</p>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-col sm:flex-row gap-4 items-end sm:items-center">
                <div class="w-full sm:w-1/3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="w-full sm:w-1/4">
                    <select name="hak_akses_id" class="block w-full py-2 px-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Semua Hak Akses --</option>
                        @foreach($hakAkses as $role)
                            <option value="{{ $role->id }}" {{ request('hak_akses_id') == $role->id ? 'selected' : '' }}>{{ $role->nama_hak_akses }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                        Cari
                    </button>
                    <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1 text-center">
                        Reset
                    </a>
                </div>
            </form>
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
                    @forelse($users as $user)
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
        <div class="px-6 py-4 border-t border-gray-100 bg-white">
            {{ $users->links() }}
        </div>
    </div>
@endsection
