@extends('layouts.admin')

@section('title', 'Edit Program Studi')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.program-studi.index') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Data Program Studi</h3>
                <p class="text-gray-500 text-sm mt-1">Perbarui formulir di bawah ini untuk mengubah data program studi.</p>
            </div>

            <form action="{{ route('admin.program-studi.update', $programStudi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="kode_prodi" class="block text-sm font-semibold text-gray-700 mb-2">Kode Program Studi</label>
                    <input type="text" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi', $programStudi->kode_prodi) }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200" placeholder="Contoh: AB-D3" required>
                    @error('kode_prodi')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_prodi" class="block text-sm font-semibold text-gray-700 mb-2">Nama Program Studi</label>
                    <input type="text" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $programStudi->nama_prodi) }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200" placeholder="Contoh: Administrasi Bisnis D3" required>
                    @error('nama_prodi')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-600/30 hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
