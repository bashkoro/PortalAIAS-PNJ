<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Deklarasi - Portal Asesmen AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="flex flex-col md:flex-row">

    <!-- Sidebar -->
    <div class="bg-white border-r border-gray-200 h-16 fixed bottom-0 md:sticky md:top-0 md:h-screen z-30 w-full md:w-64 border-t md:border-t-0">
        <div class="md:h-[73px] md:w-full md:flex md:items-center md:justify-center hidden border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-600 to-emerald-800 flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-sm">AI</span>
                </div>
                <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-emerald-600">PNJ</span></span>
            </div>
        </div>
        <ul class="flex flex-row md:flex-col py-0 md:py-4 text-center md:text-left justify-around md:justify-start w-full h-full md:h-auto">
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('mahasiswa.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('mahasiswa.deklarasi.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-emerald-600 no-underline border-b-4 border-emerald-600 md:border-b-0 md:border-l-4 hover:bg-gray-50 transition-colors bg-emerald-50">
                    <i class="fas fa-file-signature pr-0 md:pr-3 text-emerald-600 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base text-emerald-600 font-medium md:font-semibold block md:inline-block">Deklarasi</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('mahasiswa.riwayat') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-history pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Riwayat</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-0 pb-24 md:pb-5">

        <!-- Header -->
        <div class="bg-white border-b border-gray-200 w-full p-4 flex justify-between items-center sticky top-0 z-20 h-[73px]">
            <div class="flex items-center gap-3">
                <a href="{{ route('mahasiswa.deklarasi.index') }}" class="text-gray-500 hover:text-gray-800"><i class="fas fa-arrow-left"></i></a>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Formulir Deklarasi Mandiri</h1>
            </div>
            <div class="md:hidden">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-600 to-emerald-800 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-emerald-600">PNJ</span></span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4 font-medium">{{ Auth::user()->nama ?? 'Mahasiswa' }}</span>
            </div>
        </div>

        <div class="p-4 md:p-8 max-w-4xl mx-auto">
            
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                    <p class="font-bold">Gagal Mengirim Deklarasi</p>
                    <ul class="list-disc ml-5 mt-2 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Task Detail Card -->
            <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 border border-gray-200 mb-6 overflow-hidden">
                <div class="bg-emerald-50 border-b border-blue-50 p-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-emerald-700 text-sm font-semibold uppercase tracking-wider">Detail Tugas</span>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-600 text-sm">{{ $tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }}</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $tugas->judul }}</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $tugas->deskripsi }}</p>
                </div>
                <div class="p-6 bg-white flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Batas Maksimal Penggunaan AI yang Diizinkan:</p>
                        <div class="flex items-center gap-3">
                            <span class="bg-emerald-600 text-white font-bold py-1.5 px-3 rounded-md text-sm">
                                {{ $tugas->tingkatAiasAkhir->nama_tingkat ?? 'Tidak Diketahui' }}
                            </span>
                            <span class="text-gray-700 text-sm font-medium">{{ $tugas->tingkatAiasAkhir->deskripsi ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Declaration Form -->
            <form action="{{ route('mahasiswa.deklarasi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 border border-gray-200 overflow-hidden">
                @csrf
                <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
                
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Rincian Penggunaan AI (Opsional)</h3>
                    <p class="text-sm text-gray-500 mb-6">Jika Anda menggunakan bantuan AI dalam penyelesaian tugas ini, silakan isi rincian di bawah. Jika tidak, Anda dapat mengosongkannya.</p>

                    <div class="space-y-5">
                        <div>
                            <label for="nama_platform_ai" class="block text-sm font-medium text-gray-700 mb-1">Platform AI yang Digunakan (misal: ChatGPT, Claude)</label>
                            <input type="text" name="nama_platform_ai" id="nama_platform_ai" value="{{ old('nama_platform_ai') }}" class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-black focus:border-black sm:text-sm">
                        </div>

                        <div>
                            <label for="prompt_dikirim" class="block text-sm font-medium text-gray-700 mb-1">Prompt yang Dikirim (Prompt History)</label>
                            <textarea name="prompt_dikirim" id="prompt_dikirim" rows="3" class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-black focus:border-black sm:text-sm">{{ old('prompt_dikirim') }}</textarea>
                        </div>

                        <div>
                            <label for="respons_ai" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan Respons AI</label>
                            <textarea name="respons_ai" id="respons_ai" rows="3" class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-black focus:border-black sm:text-sm">{{ old('respons_ai') }}</textarea>
                        </div>

                        <div>
                            <label for="bukti_file" class="block text-sm font-medium text-gray-700 mb-1">Unggah Tangkapan Layar (Screenshot) / Bukti PDF</label>
                            <input type="file" name="bukti_file" id="bukti_file" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 border border-gray-300 rounded-md">
                            <p class="mt-1 text-xs text-gray-500">Maksimal 2MB. Format: JPG, PNG, PDF.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50">
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="pernyataan_disetujui" name="pernyataan_disetujui" type="checkbox" value="1" class="focus:ring-black h-4 w-4 text-black border-gray-300 rounded" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="pernyataan_disetujui" class="font-medium text-gray-700">Pakta Integritas Akademik</label>
                            <p class="text-gray-500">Saya menyatakan dengan jujur bahwa informasi penggunaan AI yang saya berikan adalah benar, dan saya telah mematuhi batasan skor AI yang ditetapkan ({{ $tugas->tingkatAiasAkhir->nama_tingkat ?? 'Level' }}) untuk tugas ini. Saya menyadari konsekuensi atas pelanggaran integritas akademik.</p>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-black border border-transparent rounded-md shadow-sm py-2 px-6 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                            Kirim Deklarasi
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>