<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Portal Asesmen AI</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans leading-normal tracking-normal text-gray-900 selection:bg-emerald-600 selection:text-white">

<div class="flex flex-col md:flex-row min-h-screen">

    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content flex-1 bg-slate-50 mt-12 md:mt-0 pb-24 md:pb-5">
        
        @include('layouts.header')

        <div class="p-4 md:p-8 max-w-7xl mx-auto">
            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
