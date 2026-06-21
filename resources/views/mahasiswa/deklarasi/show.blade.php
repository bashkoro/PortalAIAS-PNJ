@extends('layouts.mahasiswa')

@section('title', 'Detail Deklarasi AI')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Detail Deklarasi AI</h2>
        <a href="{{ route('mahasiswa.riwayat') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors">
            <svg class="mr-2 -ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg border-t-4 border-emerald-500">
        
        <!-- Bagian 1: Informasi Umum -->
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Umum</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail penugasan dan hasil klasifikasi AIAS.</p>
            </div>
            <!-- Badge Level AIAS -->
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm">
                {{ $deklarasi->tingkatAias->nama_tingkat ?? 'AI-Assisted' }}
            </span>
        </div>
        
        <div class="px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Tugas / Mata Kuliah</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-semibold">
                        {{ $deklarasi->tugas->judul ?? '-' }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Penyerahan</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $deklarasi->waktu_pengumpulan ? \Carbon\Carbon::parse($deklarasi->waktu_pengumpulan)->translatedFormat('l, d F Y H:i') : '-' }} WIB
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Pernyataan Mahasiswa</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 italic">
                        "Saya menyatakan dengan sejujur-jujurnya bahwa informasi penggunaan AI yang saya deklarasikan di atas adalah benar." (Disetujui)
                    </dd>
                </div>

                <!-- Bagian Rincian Penggunaan AI -->
                <div class="px-4 py-5 sm:px-6 border-t border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Rincian Penggunaan AI</h3>
                </div>

                <div class="py-4 sm:py-5 px-6">
                    @if($deklarasi->riwayatPrompt && $deklarasi->riwayatPrompt->count() > 0)
                        @foreach($deklarasi->riwayatPrompt as $index => $prompt)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 mb-4">
                                <h4 class="font-bold text-gray-800 mb-3 border-b pb-2">Platform AI: {{ $prompt->nama_platform_ai ?? '-' }}</h4>
                                
                                <div class="mb-3">
                                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Prompt yang Dikirim</span>
                                    <div class="text-sm text-gray-800 bg-gray-50 p-3 rounded border border-gray-100 whitespace-pre-wrap">{{ $prompt->prompt_dikirim ?? '-' }}</div>
                                </div>
                                
                                <div class="mb-3">
                                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Ringkasan Respons AI</span>
                                    <div class="text-sm text-gray-800 bg-gray-50 p-3 rounded border border-gray-100 whitespace-pre-wrap">{{ $prompt->respons_ai ?? '-' }}</div>
                                </div>

                                @if($prompt->link_conversation)
                                    <div>
                                        <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Link Conversation</span>
                                        <a href="{{ $prompt->link_conversation }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 underline">{{ $prompt->link_conversation }}</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500 italic">Tidak ada riwayat penggunaan prompt atau tools AI yang dideklarasikan.</p>
                    @endif
                </div>

                <!-- Bagian 2: Bukti Unggahan -->
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <dt class="text-sm font-medium text-gray-500">Lampiran Bukti Prompt</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($deklarasi->path_file_bukti)
                            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm bg-white">
                                    <div class="w-0 flex-1 flex items-center">
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            Bukti_Deklarasi_{{ $deklarasi->id }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="{{ asset('storage/' . $deklarasi->path_file_bukti) }}" target="_blank" class="font-medium text-emerald-600 hover:text-emerald-500">
                                            Lihat Dokumen
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <span class="text-gray-400">Tidak ada file yang dilampirkan.</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
        
    </div>
</div>
@endsection
