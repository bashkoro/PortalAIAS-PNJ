@extends('layouts.admin')

@section('title', 'Edit Kelas Kuliah')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.kelas-kuliah.index') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-100 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-xl font-bold text-gray-900">Edit Data Kelas Kuliah</h3>
                <p class="text-gray-500 text-sm mt-1">Perbarui formulir di bawah ini untuk mengubah data kelas kuliah.</p>
            </div>

            <form action="{{ route('admin.kelas-kuliah.update', $kelasKuliah->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="nama_kelas" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelasKuliah->nama_kelas) }}" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" placeholder="Contoh: TI-4A" required>
                    @error('nama_kelas')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="mata_kuliah_id" class="block text-sm font-semibold text-gray-700 mb-2">Mata Kuliah</label>
                    <select name="mata_kuliah_id" id="mata_kuliah_id" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors bg-white" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($mataKuliah as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $kelasKuliah->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>
                                {{ $mk->nama_mk }}
                            </option>
                        @endforeach
                    </select>
                    @error('mata_kuliah_id')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dosen_id" class="block text-sm font-semibold text-gray-700 mb-2">Dosen Pengampu</label>
                    <select name="dosen_id" id="dosen_id" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors bg-white" required>
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->id }}" {{ old('dosen_id', $kelasKuliah->dosen_id) == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dosen_id')
                        <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="periode_akademik_id" class="block text-sm font-semibold text-gray-700 mb-2">Periode Akademik</label>
                    <select name="periode_akademik_id" id="periode_akademik_id" class="block w-full py-2.5 px-3 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors bg-white" required>
                        <option value="">-- Pilih Periode --</option>
                        @foreach($periodeAkademik as $periode)
                            <option value="{{ $periode->id }}" {{ old('periode_akademik_id', $kelasKuliah->periode_akademik_id) == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama_periode }}
                            </option>
                        @endforeach
                    </select>
                    @error('periode_akademik_id')
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
