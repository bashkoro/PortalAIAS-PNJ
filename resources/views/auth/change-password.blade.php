<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - Portal Asesmen AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-2xl w-full">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="javascript:history.back()" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-100 p-8">
            <div class="border-b border-gray-100 pb-5 mb-6">
                <h3 class="text-xl font-bold text-gray-900">Ganti Password</h3>
                <p class="text-gray-500 text-sm mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="mb-6 p-4 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span>Password berhasil diperbarui!</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="current_password" name="current_password" required
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               placeholder="••••••••" autocomplete="current-password">
                    </div>
                    @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-xs font-medium mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               placeholder="••••••••" autocomplete="new-password">
                    </div>
                    @error('password', 'updatePassword')
                        <p class="text-red-500 text-xs font-medium mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm shadow-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition-colors" 
                               placeholder="••••••••" autocomplete="new-password">
                    </div>
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
