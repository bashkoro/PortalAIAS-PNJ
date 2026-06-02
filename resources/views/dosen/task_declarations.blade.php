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
                <a href="{{ route('dosen.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-chart-pie pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Dashboard</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('dosen.tugas.create') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-plus-circle pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Buat Tugas</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('dosen.riwayat') }}" class="block py-3 md:py-3 pl-1 align-middle text-blue-600 no-underline border-b-4 border-blue-600 md:border-b-0 md:border-l-4 hover:bg-gray-50 transition-colors bg-blue-50">
                    <i class="fas fa-history pr-0 md:pr-3 text-blue-600 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base text-blue-600 font-medium md:font-semibold block md:inline-block">Riwayat</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-0 pb-24 md:pb-5">

        <!-- Header -->
        <div class="bg-white border-b border-gray-200 w-full p-4 flex justify-between items-center sticky top-0 z-20 h-[73px]">
            <div class="flex items-center gap-3">
                <a href="{{ route('dosen.riwayat') }}" class="text-gray-500 hover:text-gray-800"><i class="fas fa-arrow-left"></i></a>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Kepatuhan Deklarasi Mahasiswa</h1>
            </div>
            <div class="md:hidden">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4 font-medium">{{ Auth::user()->nama ?? 'Dosen Tester' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm transition-colors border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-md hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-1"></i>Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 md:p-8">
            
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-6 overflow-hidden">
                <div class="bg-blue-50 border-b border-blue-50 p-6">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-blue-700 text-sm font-semibold uppercase tracking-wider">Detail Tugas</span>
                        @if($tugas->tingkatAiasAkhir)
                            <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $tugas->tingkatAiasAkhir->nama_tingkat }}</span>
                        @endif
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $tugas->judul }}</h2>
                    <p class="text-gray-600 text-sm">{{ $tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }} - {{ $tugas->kelasKuliah->nama_kelas ?? '-' }}</p>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">Daftar Deklarasi Masuk</h3>
                    <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs font-bold">{{ $deklarasi->count() }} Terkumpul</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="py-3 px-6 text-center border-b border-gray-200 w-16">No</th>
                                <th class="py-3 px-6 text-left border-b border-gray-200">Nama Mahasiswa</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Waktu Pengumpulan</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Status Pernyataan</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Lampiran Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($deklarasi as $index => $item)
                            <tr class="hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                <td class="py-4 px-6 text-center text-gray-500">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 text-left">
                                    <div class="font-medium text-gray-900">{{ $item->mahasiswa->nama ?? '-' }}</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{ $item->waktu_pengumpulan ? \Carbon\Carbon::parse($item->waktu_pengumpulan)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($item->pernyataan_disetujui)
                                        <span class="text-blue-700 font-medium"><i class="fas fa-check-circle mr-1"></i> Disetujui</span>
                                    @else
                                        <span class="text-red-600 font-medium"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($item->path_file_bukti)
                                        <a href="{{ asset('storage/' . $item->path_file_bukti) }}" target="_blank" class="text-blue-600 hover:text-blue-700 underline flex items-center justify-center gap-1">
                                            <i class="fas fa-file-alt"></i> Lihat File
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs italic">Tidak ada lampiran</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 px-6 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p>Belum ada mahasiswa yang mengumpulkan deklarasi untuk tugas ini.</p>
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