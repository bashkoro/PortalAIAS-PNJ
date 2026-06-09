<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Deklarasi - Portal Asesmen AI</title>
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
                <a href="{{ route('mahasiswa.deklarasi.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-file-signature pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Deklarasi</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('mahasiswa.riwayat') }}" class="block py-3 md:py-3 pl-1 align-middle text-emerald-600 no-underline border-b-4 border-emerald-600 md:border-b-0 md:border-l-4 hover:bg-gray-50 transition-colors bg-emerald-50">
                    <i class="fas fa-history pr-0 md:pr-3 text-emerald-600 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base text-emerald-600 font-medium md:font-semibold block md:inline-block">Riwayat</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-0 pb-24 md:pb-5">

        <!-- Header -->
        <div class="bg-white border-b border-gray-200 w-full p-4 flex justify-between items-center sticky top-0 z-20 h-[73px]">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Riwayat Deklarasi</h1>
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
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm transition-colors border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-md hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-1"></i>Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 md:p-8">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-green-500 text-emerald-700 p-4 mb-6 rounded-r shadow-sm flex justify-between items-center" role="alert">
                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-2xl border border-gray-100/80 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100/80 bg-white">
                    <h3 class="font-bold text-gray-800 text-lg">Deklarasi yang Telah Disubmit</h3>
                    <p class="text-sm text-gray-500">Tugas yang telah Anda kirim deklarasinya.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="py-3 px-6 text-left border-b border-gray-200">Tugas & Mata Kuliah</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Waktu Submit</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Level AIAS</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Detail Deklarasi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($deklarasi as $item)
                            <tr class="hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                <td class="py-4 px-6 text-left">
                                    <div class="font-medium text-gray-900">{{ $item->tugas->judul ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }}</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{ $item->waktu_pengumpulan ? \Carbon\Carbon::parse($item->waktu_pengumpulan)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-emerald-50 text-emerald-700 py-1 px-3 rounded-full text-xs font-bold">{{ $item->tugas->tingkatAiasAkhir->nama_tingkat ?? '-' }}</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('mahasiswa.deklarasi.show', $item->id) }}" class="inline-flex items-center px-3 py-1.5 border border-emerald-500 text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 text-xs font-semibold">
                                        <i class="fas fa-eye mr-1.5"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 px-6 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p>Belum ada riwayat deklarasi.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>