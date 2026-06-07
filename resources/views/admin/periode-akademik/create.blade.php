@extends('layouts.admin')

@section('title', 'Tambah Periode Akademik')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.periode-akademik.index') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-100 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-xl font-bold text-gray-900">Tambah Data Periode Akademik</h3>
                <p class="text-gray-500 text-sm mt-1">Isi formulir di bawah ini untuk menambahkan periode akademik baru. Mengaktifkan periode baru akan menonaktifkan periode lainnya.</p>
            </div>

            <form action="{{ route('admin.periode-akademik.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="nama_periode" class="block text-sm font-semibold text-gray-700 mb-2">Nama Periode</label>
                    <input type="text" name="nama_periode" id="nama_periode" value="{{ old('nama_periode') }}" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" placeholder="Contoh: 2025/2026 Genap" required>
                    @error('nama_periode')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="is_active" class="ml-2 block text-sm font-medium text-gray-700 cursor-pointer">
                        Set sebagai Periode Aktif
                    </label>
                </div>
                @error('is_active')
                    <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-sm">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
