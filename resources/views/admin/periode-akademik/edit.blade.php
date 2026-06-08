@extends('layouts.admin')

@section('title', 'Edit Periode Akademik')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.periode-akademik.index') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Data Periode Akademik</h3>
                <p class="text-gray-500 text-sm mt-1">Perbarui formulir di bawah ini untuk mengubah data periode akademik.</p>
            </div>

            <form action="{{ route('admin.periode-akademik.update', $periodeAkademik->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="nama_periode" class="block text-sm font-semibold text-gray-700 mb-2">Nama Periode</label>
                    <input type="text" name="nama_periode" id="nama_periode" value="{{ old('nama_periode', $periodeAkademik->nama_periode) }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200" placeholder="Contoh: 2025/2026 Genap" required>
                    @error('nama_periode')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $periodeAkademik->is_active) ? 'checked' : '' }} class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded cursor-pointer">
                    <label for="is_active" class="ml-2 block text-sm font-medium text-gray-700 cursor-pointer">
                        Set sebagai Periode Aktif
                    </label>
                </div>
                @error('is_active')
                    <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                @enderror

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-600/30 hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
