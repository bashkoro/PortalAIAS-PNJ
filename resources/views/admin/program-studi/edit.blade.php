@extends('layouts.admin')

@section('title', 'Edit Program Studi')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.program-studi.index') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-100 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-xl font-bold text-gray-900">Edit Data Program Studi</h3>
                <p class="text-gray-500 text-sm mt-1">Perbarui formulir di bawah ini untuk mengubah data program studi.</p>
            </div>

            <form action="{{ route('admin.program-studi.update', $programStudi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="kode_prodi" class="block text-sm font-semibold text-gray-700 mb-2">Kode Program Studi</label>
                    <input type="text" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi', $programStudi->kode_prodi) }}" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" placeholder="Contoh: AB-D3" required>
                    @error('kode_prodi')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_prodi" class="block text-sm font-semibold text-gray-700 mb-2">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $programStudi->nama_prodi) }}" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" placeholder="Contoh: Administrasi Bisnis D3" required>
                    @error('nama_prodi')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-sm">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
