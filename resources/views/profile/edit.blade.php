<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Portal Asesmen AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Top Navbar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">AI</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900 hidden sm:block">Score<span class="text-blue-600">PNJ</span></span>
                </div>
                
                @php
                    $dashboardRoute = 'login';
                    if (Auth::user()->checkRole('Admin')) $dashboardRoute = 'admin.dashboard';
                    elseif (Auth::user()->checkRole('Dosen')) $dashboardRoute = 'dosen.dashboard';
                    elseif (Auth::user()->checkRole('Mahasiswa')) $dashboardRoute = 'mahasiswa.dashboard';
                @endphp

                <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition-all">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 uppercase tracking-tight">Pengaturan Profil</h1>

        @if (session('status') === 'profile-updated')
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <span class="font-medium">Profil Anda telah berhasil diperbarui.</span>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <span class="font-medium">Kata sandi Anda telah berhasil diubah.</span>
            </div>
        @endif

        <!-- Informasi Profil Card -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-user-circle text-blue-600"></i> Informasi Profil
                </h3>
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Perbarui nama dan alamat email akun Anda.</p>
            </div>
            <form method="post" action="{{ route('profile.update') }}" class="p-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="nama" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium" required>
                    @error('nama')
                        <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium" required>
                    @error('email')
                        <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-black text-xs hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Ganti Password Card -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-key text-blue-600"></i> Ganti Kata Sandi
                </h3>
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
            </div>
            <form method="post" action="{{ route('profile.password') }}" class="p-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium">
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium">
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-gray-50 border border-gray-200 rounded-lg shadow-sm py-3 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-sm font-medium">
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-black text-xs hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
