<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deklarasi Tugas - Portal Asesmen AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="flex flex-col md:flex-row">

    <!-- Sidebar -->
    <div class="bg-white border-r border-gray-200 h-16 fixed bottom-0 md:sticky md:top-0 md:h-screen z-30 w-full md:w-64 border-t md:border-t-0">
        <div class="md:h-[73px] md:w-full md:flex md:items-center md:justify-center hidden border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-sm">AI</span>
                </div>
                <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
            </div>
        </div>
        <ul class="flex flex-row md:flex-col py-0 md:py-4 text-center md:text-left justify-around md:justify-start w-full h-full md:h-auto">
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('mahasiswa.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('mahasiswa.deklarasi.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-blue-600 no-underline border-b-4 border-blue-600 md:border-b-0 md:border-l-4 hover:bg-gray-50 transition-colors bg-blue-50">
                    <i class="fas fa-file-signature pr-0 md:pr-3 text-blue-600 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base text-blue-600 font-medium md:font-semibold block md:inline-block">Deklarasi</span>
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
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Daftar Tugas Aktif</h1>
            <div class="md:hidden">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4 font-medium">{{ Auth::user()->nama ?? 'Mahasiswa' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm transition-colors border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-md hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-1"></i>Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 md:p-8">
            <p class="text-gray-600 mb-6">Berikut adalah daftar tugas yang belum Anda berikan Deklarasi Penggunaan AI. Silakan isi deklarasi untuk masing-masing tugas.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tugas as $item)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $item->kelasKuliah->mataKuliah->nama_mk ?? '-' }}</span>
                            @if($item->tingkatAiasAkhir)
                                <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2.5 py-0.5 rounded">{{ $item->tingkatAiasAkhir->nama_tingkat }}</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->judul }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        <a href="{{ route('mahasiswa.deklarasi.show', $item->id) }}" class="block w-full text-center bg-black hover:bg-gray-800 text-white font-medium py-2 px-4 rounded transition-colors">
                            Buat Deklarasi
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white p-8 rounded-lg border border-gray-200 text-center text-gray-500">
                    <i class="fas fa-check-circle text-4xl mb-3 text-green-400"></i>
                    <p class="text-lg font-medium">Bagus!</p>
                    <p>Tidak ada tugas yang menunggu deklarasi.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

</body>
</html>