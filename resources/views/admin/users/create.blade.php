@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Tambah Pengguna Baru</h2>
                <p class="text-sm text-gray-500 mt-1">Buat akun pengguna baru dan tentukan hak aksesnya.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                <div class="font-bold flex items-center mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Terdapat kesalahan:</div>
                <ul class="list-disc list-inside space-y-1 ml-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="p-8 space-y-6">
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap pengguna" 
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh: dosen@univ.ac.id" 
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi <span class="text-red-500">*</span></label>
                            <input type="password" name="password" required placeholder="Minimal 8 karakter" 
                                class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm">
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" 
                                class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Hak Akses -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Hak Akses (Role) <span class="text-red-500">*</span></label>
                            <select name="hak_akses_id" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm appearance-none">
                                <option value="" disabled selected>-- Pilih Hak Akses --</option>
                                @foreach($hakAkses as $role)
                                    <option value="{{ $role->id }}" {{ old('hak_akses_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->nama_hak_akses }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Program Studi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Program Studi <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                            <select name="program_studi_id" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm appearance-none">
                                <option value="">-- Tidak terikat prodi --</option>
                                @foreach($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-sm">
                        <i class="fas fa-save mr-2"></i> Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
