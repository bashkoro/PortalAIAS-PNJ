@extends('layouts.admin')

@section('title', 'Edit Aturan AIAS')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Aturan Klasifikasi</h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui kondisi (IF) atau hasil akhir (THEN) aturan ID #{{ $rule->id }}.</p>
            </div>
            <a href="{{ route('admin.rules.index') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors flex items-center gap-2">
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
            <form action="{{ route('admin.rules.update', $rule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="p-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2"><i class="fas fa-filter text-emerald-500 mr-2"></i> Bagian IF (Kondisi)</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @foreach($kriteriaOptions as $key => $options)
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide text-[11px]">{{ str_replace('_', ' ', $key) }}</label>
                                <select name="kondisi[{{ $key }}]" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors bg-gray-50 focus:bg-white text-sm appearance-none">
                                    <option value="">-- Abaikan Kriteria Ini --</option>
                                    @foreach($options as $option)
                                        <option value="{{ $option }}" {{ old('kondisi.'.$key, $kondisiCurrent[$key] ?? '') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2"><i class="fas fa-arrow-right text-indigo-500 mr-2"></i> Bagian THEN (Hasil)</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat AIAS Akhir <span class="text-red-500">*</span></label>
                        <select name="tingkat_aias_id" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors bg-gray-50 focus:bg-white text-sm appearance-none">
                            <option value="" disabled>-- Pilih Tingkat AIAS --</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ old('tingkat_aias_id', $rule->tingkat_aias_id) == $level->id ? 'selected' : '' }}>
                                    {{ $level->nama_tingkat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-sm">
                        <i class="fas fa-save mr-2"></i> Perbarui Aturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
