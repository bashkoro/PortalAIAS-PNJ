<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Portal Asesmen AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white shadow-sm rounded-lg border border-gray-100 p-8 text-center">
        
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
            <i class="fas fa-envelope-open-text text-blue-600 text-2xl"></i>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-2">Verifikasi Email Anda</h2>
        
        <p class="text-gray-500 text-sm mb-6 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan. 
            Jika Anda tidak menerima email tersebut, kami dapat mengirimkan ulang.
        </p>

        @if (session('message') == 'Verification link sent!')
            <div class="mb-6 p-4 text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg flex items-start text-left">
                <i class="fas fa-check-circle mt-0.5 mr-3"></i>
                <span>Tautan verifikasi baru telah dikirimkan ke alamat email Anda.</span>
            </div>
        @endif

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                    Kirim Ulang Link Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-offset-2 transition-all">
                    Keluar
                </button>
            </form>
        </div>
    </div>

</body>
</html>
