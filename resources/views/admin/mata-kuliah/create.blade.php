@extends('layouts.admin')

@section('title', 'Tambah Mata Kuliah')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Tambah Data Mata Kuliah</h3>
                <p class="text-gray-500 text-sm mt-1">Isi formulir di bawah ini untuk menambahkan mata kuliah baru.</p>
            </div>

            <form action="{{ route('admin.mata-kuliah.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="kode_mk" class="block text-sm font-semibold text-gray-700 mb-2">Kode MK</label>
                    <input type="text" name="kode_mk" id="kode_mk" value="{{ old('kode_mk') }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200" placeholder="Contoh: MK-101" required>
                    @error('kode_mk')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_mk" class="block text-sm font-semibold text-gray-700 mb-2">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" id="nama_mk" value="{{ old('nama_mk') }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200" placeholder="Contoh: Pemrograman Web" required>
                    @error('nama_mk')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="program_studi_id" class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                    <select name="program_studi_id" id="program_studi_id" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-gray-50 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 bg-white" required>
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach($programStudi as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                    @error('program_studi_id')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-600/30 hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
