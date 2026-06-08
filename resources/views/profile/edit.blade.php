<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Portal Asesmen AI</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-gray-900 selection:bg-emerald-600 selection:text-white">

    <!-- Top Navbar -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                        <span class="text-white font-bold text-xl">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900 hidden sm:block">Score<span class="text-emerald-600">PNJ</span></span>
                </div>
                
                @php
                    $dashboardRoute = 'login';
                    if (Auth::user()->checkRole('Admin')) $dashboardRoute = 'admin.dashboard';
                    elseif (Auth::user()->checkRole('Dosen')) $dashboardRoute = 'dosen.dashboard';
                    elseif (Auth::user()->checkRole('Mahasiswa')) $dashboardRoute = 'mahasiswa.dashboard';
                @endphp

                <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-gray-700 transition-all duration-200 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pengaturan Profil</h1>
            <p class="text-gray-500 mt-2 text-lg">Kelola informasi akun dan preferensi keamanan Anda.</p>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm flex items-start">
                <i class="fas fa-check-circle mt-0.5 mr-3 text-emerald-600"></i>
                <span class="font-medium">Profil Anda telah berhasil diperbarui.</span>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-sm flex items-start">
                <i class="fas fa-check-circle mt-0.5 mr-3 text-emerald-600"></i>
                <span class="font-medium">Kata sandi Anda telah berhasil diubah.</span>
            </div>
        @endif

        <!-- Informasi Profil Card -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/80 overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-100/80 bg-white">
                <h3 class="font-extrabold text-gray-900 text-xl tracking-tight flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    Informasi Profil
                </h3>
                <p class="text-sm text-gray-500 mt-2 font-medium">Perbarui nama lengkap dan alamat email yang tertaut pada akun Anda.</p>
            </div>
            <form method="post" action="{{ route('profile.update') }}" class="p-8 space-y-6 bg-gray-50/30">
                @csrf
                @method('patch')

                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 font-medium" required>
                    @error('nama')
                        <p class="mt-2 text-xs text-red-500 font-medium flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 font-medium" required>
                    @error('email')
                        <p class="mt-2 text-xs text-red-500 font-medium flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-600/30 hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Ganti Password Card -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/80 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100/80 bg-white">
                <h3 class="font-extrabold text-gray-900 text-xl tracking-tight flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    Keamanan & Kata Sandi
                </h3>
                <p class="text-sm text-gray-500 mt-2 font-medium">Pastikan akun Anda menggunakan kata sandi yang panjang, unik, dan acak untuk menjaga keamanan data.</p>
            </div>
            <form method="post" action="{{ route('profile.password') }}" class="p-8 space-y-6 bg-gray-50/30">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 font-medium" placeholder="••••••••">
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-xs text-red-500 font-medium flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 font-medium" placeholder="••••••••">
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-xs text-red-500 font-medium flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full py-3 px-4 border border-gray-200 rounded-xl text-sm shadow-sm bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 font-medium" placeholder="••••••••">
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-xs text-red-500 font-medium flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex items-center gap-4">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-600/30 hover:-translate-y-0.5">
                        <i class="fas fa-key mr-2"></i> Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
