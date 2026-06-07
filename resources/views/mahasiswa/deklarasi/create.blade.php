@extends('layouts.mahasiswa')

@section('title', 'Formulir Deklarasi Mandiri')

@section('content')
    <div class="p-4 md:p-8 max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold text-sm">Gagal Mengirim Deklarasi</p>
                <ul class="list-disc ml-5 mt-2 text-xs">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Task Detail Card -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6 overflow-hidden text-gray-900">
            <div class="bg-blue-50 border-b border-blue-100 p-6">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-blue-700 text-[10px] font-bold uppercase tracking-wider bg-white px-2 py-0.5 rounded border border-blue-200 shadow-sm">Detail Tugas</span>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600 text-[11px] font-semibold">{{ $tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }}</span>
                </div>
                <h2 class="text-2xl font-black text-gray-900 mb-4">{{ $tugas->judul }}</h2>
                <div class="bg-white/50 p-4 rounded-lg border border-blue-100/50">
                    <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $tugas->deskripsi }}</p>
                </div>
            </div>
            <div class="p-6 bg-white flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-100">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-tighter">Batas Penggunaan AI</p>
                        <div class="flex items-center gap-2 text-gray-900">
                            <span class="text-lg font-black text-blue-700">{{ $tugas->tingkatAiasAkhir->nama_tingkat ?? 'N/A' }}</span>
                            <span class="text-xs text-gray-500 font-medium">({{ $tugas->tingkatAiasAkhir->deskripsi ?? '' }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Declaration Form -->
        <form action="{{ route('mahasiswa.deklarasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
            
            <!-- Part 1: Kondisi Penggunaan AI (AID Framework) -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px] font-bold shadow-md shadow-blue-100">1</div>
                    <h3 class="font-bold text-gray-800">Aspek Penggunaan AI <span class="text-red-500">* (Wajib Diisi)</span></h3>
                </div>
                <div class="p-6">
                    <p class="text-[11px] text-gray-500 mb-6 font-medium italic">Berdasarkan AID Framework, silakan centang aspek pengerjaan yang dibantu oleh AI:</p>
                    
                    <div class="space-y-3">
                        @foreach($daftar_kondisi as $aspek => $keterangan)
                            <label class="flex items-start p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-blue-50/50 hover:border-blue-200 transition-all cursor-pointer group">
                                <div class="flex items-center h-5 mt-0.5">
                                    <input type="checkbox" name="kondisi_penggunaan[]" value="{{ $aspek }}" class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 shadow-sm transition-all">
                                </div>
                                <div class="ml-4">
                                    <span class="block text-sm font-black text-gray-800 group-hover:text-blue-700 transition-colors uppercase tracking-tight">{{ $aspek }}</span>
                                    <span class="block text-xs text-gray-500 font-medium mt-0.5">{{ $keterangan }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Part 2: Rincian Deklarasi (Manual Inputs) -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-gray-300 text-white flex items-center justify-center text-[10px] font-bold shadow-sm">2</div>
                    <h3 class="font-bold text-gray-800">Rincian Deklarasi Penggunaan <span class="text-gray-400 text-xs font-normal italic ml-1">(Pendukung)</span></h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="nama_platform_ai" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Platform AI (misal: ChatGPT, Claude)</label>
                        <input type="text" name="nama_platform_ai" id="nama_platform_ai" value="{{ old('nama_platform_ai') }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-300 font-medium" placeholder="ChatGPT 4o, Claude 3.5 Sonnet, dll...">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="prompt_dikirim" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Prompt yang Dikirim</label>
                            <textarea name="prompt_dikirim" id="prompt_dikirim" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-300 font-medium" placeholder="Contoh: 'Buatlah kerangka makalah tentang...' atau 'Perbaiki tata bahasa paragraf ini...'">{{ old('prompt_dikirim') }}</textarea>
                        </div>

                        <div>
                            <label for="respons_ai" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Ringkasan Respons AI</label>
                            <textarea name="respons_ai" id="respons_ai" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-300 font-medium" placeholder="Ringkas secara singkat apa yang dihasilkan AI dan bagaimana Anda menggunakannya...">{{ old('respons_ai') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="link_conversation" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Link Conversation AI <span class="text-[9px] font-normal italic">(Opsional)</span></label>
                        <input type="url" name="link_conversation" id="link_conversation" value="{{ old('link_conversation') }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm text-gray-800 placeholder-gray-300 font-medium" placeholder="https://chatgpt.com/share/...">
                    </div>

                    <div>
                        <label for="bukti_file" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Unggah Screenshot Bukti (JPG/PNG/PDF)</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3 group-hover:text-blue-500 transition-colors"></i>
                                    <p class="mb-1 text-sm text-gray-500 font-black uppercase tracking-tighter">Klik atau seret berkas ke sini</p>
                                    <p class="text-[10px] text-gray-400 font-bold">PDF, PNG, atau JPG (Maks. 2MB)</p>
                                </div>
                                <input type="file" name="bukti_file" id="bukti_file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Part 3: Pakta Integritas -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 shadow-blue-50 shadow-inner">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="pernyataan_disetujui" name="pernyataan_disetujui" type="checkbox" value="1" class="h-6 w-6 text-blue-600 border-gray-300 rounded-lg focus:ring-blue-500 cursor-pointer shadow-sm" required>
                    </div>
                    <div class="ml-4">
                        <label for="pernyataan_disetujui" class="text-sm font-black text-gray-800 cursor-pointer uppercase tracking-tight">Pakta Integritas Akademik</label>
                        <p class="text-gray-500 text-xs mt-1 leading-relaxed font-medium">Saya menyatakan dengan sejujur-jujurnya bahwa informasi penggunaan AI yang saya deklarasikan di atas adalah benar. Saya memahami bahwa ketidakjujuran dalam pengisian formulir ini merupakan bentuk pelanggaran integritas akademik yang dapat dikenai sanksi sesuai peraturan yang berlaku di Politeknik Negeri Jakarta.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="w-full md:w-auto px-12 py-5 bg-blue-600 text-white rounded-2xl font-black text-sm hover:bg-blue-700 transition-all shadow-2xl shadow-blue-200 flex items-center justify-center gap-3 uppercase tracking-widest active:scale-95">
                    <i class="fas fa-paper-plane opacity-70 text-xs"></i> Kirim Deklarasi & Proses AIAS
                </button>
            </div>
        </form>
    </div>
@endsection
