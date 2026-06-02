<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas - Portal Asesmen AI</title>
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
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Riwayat Penugasan</h1>
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
            
            @if(session('success'))
                <div class="bg-blue-50 border-l-4 border-green-500 text-blue-700 p-4 mb-6 rounded-r shadow-sm flex justify-between items-center" role="alert">
                    <div>
                        <p class="font-bold">Sukses</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">Daftar Semua Penugasan</h3>
                    <a href="{{ route('dosen.tugas.create') }}" class="inline-flex items-center justify-center rounded-md bg-blue-600 text-white px-4 py-2 text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i> Tugas Baru
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="py-3 px-6 text-center border-b border-gray-200 w-16">No</th>
                                <th class="py-3 px-6 text-left border-b border-gray-200">Judul Tugas</th>
                                <th class="py-3 px-6 text-left border-b border-gray-200">Mata Kuliah / Kelas</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Hasil AI Score</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Status</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Deklarasi Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($tugas as $index => $item)
                            <tr class="hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                <td class="py-4 px-6 text-center text-gray-500">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 text-left">
                                    <div class="font-medium text-gray-800">{{ $item->judul }}</div>
                                    <div class="text-xs text-gray-500 truncate max-w-xs" title="{{ $item->deskripsi }}">{{ Str::limit($item->deskripsi, 50) }}</div>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <div class="font-medium">{{ $item->kelasKuliah->mataKuliah->nama_mk ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->kelasKuliah->nama_kelas ?? '-' }}</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($item->tingkatAiasAkhir)
                                        @php
                                            $level = $item->tingkatAiasAkhir->nama_tingkat;
                                            $colorClass = 'bg-gray-100 text-gray-800';
                                            if (str_contains($level, '1')) $colorClass = 'bg-blue-50 text-green-800';
                                            elseif (str_contains($level, '2')) $colorClass = 'bg-blue-50 text-blue-700';
                                            elseif (str_contains($level, '3')) $colorClass = 'bg-yellow-100 text-yellow-800';
                                            elseif (str_contains($level, '4')) $colorClass = 'bg-blue-50 text-purple-800';
                                            elseif (str_contains($level, '5')) $colorClass = 'bg-red-100 text-red-800';
                                        @endphp
                                        <span class="{{ $colorClass }} py-1 px-3 rounded-full text-xs font-bold" title="{{ $item->tingkatAiasAkhir->deskripsi }}">
                                            {{ $level }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic text-xs">Belum Diklasifikasi</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if(strtolower($item->status_publikasi) === 'published')
                                        <span class="bg-blue-50 text-blue-700 py-1 px-3 rounded-md text-xs font-semibold"><i class="fas fa-eye mr-1"></i> Publik</span>
                                    @else
                                        <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-md text-xs font-semibold"><i class="fas fa-file-alt mr-1"></i> Draft</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('dosen.tugas.declarations', $item->id) }}" class="inline-flex items-center justify-center bg-gray-800 hover:bg-black text-white text-xs font-semibold py-1.5 px-3 rounded shadow-sm transition-colors">
                                        <i class="fas fa-search mr-1.5"></i> Lihat Deklarasi
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-8 px-6 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                        <p>Belum ada penugasan yang dibuat.</p>
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