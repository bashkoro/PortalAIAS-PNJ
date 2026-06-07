@extends('layouts.admin')

@section('title', 'Tambah Mata Kuliah')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-100 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-xl font-bold text-gray-900">Tambah Data Mata Kuliah</h3>
                <p class="text-gray-500 text-sm mt-1">Isi formulir di bawah ini untuk menambahkan mata kuliah baru.</p>
            </div>

            <form action="{{ route('admin.mata-kuliah.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="kode_mk" class="block text-sm font-semibold text-gray-700 mb-2">Kode MK</label>
                    <input type="text" name="kode_mk" id="kode_mk" value="{{ old('kode_mk') }}" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" placeholder="Contoh: MK-101" required>
                    @error('kode_mk')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_mk" class="block text-sm font-semibold text-gray-700 mb-2">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" id="nama_mk" value="{{ old('nama_mk') }}" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" placeholder="Contoh: Pemrograman Web" required>
                    @error('nama_mk')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="program_studi_id" class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                    <select name="program_studi_id" id="program_studi_id" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors bg-white" required>
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
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-sm">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
