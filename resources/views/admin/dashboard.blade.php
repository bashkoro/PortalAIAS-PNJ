<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Portal Asesmen AI</title>
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
                <a href="{{ route('admin.dashboard') }}" class="block py-3 md:py-3 pl-1 align-middle text-blue-600 no-underline border-b-4 border-blue-600 md:border-b-0 md:border-l-4 hover:bg-gray-50 transition-colors bg-blue-50">
                    <i class="fas fa-chart-pie pr-0 md:pr-3 text-blue-600 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base text-blue-600 font-medium md:font-semibold block md:inline-block">Dashboard</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('admin.users.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-users pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Pengguna</span>
                </a>
            </li>
            <li class="flex-1 md:w-full md:mb-2">
                <a href="{{ route('admin.rules.index') }}" class="block py-3 md:py-3 pl-1 align-middle text-gray-500 no-underline border-b-4 border-transparent md:border-l-4 hover:border-gray-300 md:hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <i class="fas fa-cogs pr-0 md:pr-3 ml-4"></i><span class="pb-1 md:pb-0 text-sm md:text-base block md:inline-block">Aturan AIAS</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-0 pb-24 md:pb-5">

        <!-- Header -->
        <div class="bg-white border-b border-gray-200 w-full p-4 flex justify-between items-center sticky top-0 z-20 h-[73px]">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 hidden md:block">Dashboard Admin</h1>
            <div class="md:hidden">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-blue-600">PNJ</span></span>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4 font-medium">{{ Auth::user()->nama ?? 'Administrator' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm transition-colors border border-red-200 hover:border-red-300 px-3 py-1.5 rounded-md hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-1"></i>Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="p-4 md:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 md:hidden">Dashboard Admin</h2>
            
            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pengguna</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalPengguna }}</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-700 mr-4">
                        <i class="fas fa-cogs text-2xl"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-sm font-medium text-gray-500 uppercase tracking-wider">Aturan Aktif</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $aturanAktif }}</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-700 mr-4">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-sm font-medium text-gray-500 uppercase tracking-wider">Total Penugasan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalTugas }}</p>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-file-signature text-2xl"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-sm font-medium text-gray-500 uppercase tracking-wider">Total Deklarasi</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalDeklarasi }}</p>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 text-lg">Pengguna Terbaru</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Kelola Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="py-3 px-6 text-left border-b border-gray-200">Nama</th>
                                <th class="py-3 px-6 text-left border-b border-gray-200">Email</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Program Studi</th>
                                <th class="py-3 px-6 text-center border-b border-gray-200">Hak Akses</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($userTerbaru as $user)
                            <tr class="hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                <td class="py-4 px-6 text-left font-medium text-gray-800">{{ $user->nama }}</td>
                                <td class="py-4 px-6 text-left text-gray-600">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-center">{{ $user->programStudi->nama_prodi ?? '-' }}</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-blue-50 text-blue-700 py-1 px-3 rounded-full text-xs font-bold">{{ $user->hakAkses->nama_hak_akses ?? '-' }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 px-6 text-center text-gray-500">Tidak ada data pengguna.</td>
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