<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Asesmen AI - PNJ</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-grid-pattern {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        /* Custom transitions for AIAS levels */
        .level-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .level-card .card-inner {
            background-color: white;
            border: 1px solid #f3f4f6;
            transition: all 0.5s ease;
        }
        /* Unselected State */
        .level-card .level-title { color: #064e3b; }
        .level-card .level-desc { color: #4b5563; }
        .level-card .level-num { color: #a7f3d0; transition: all 0.5s ease; } /* Solid emerald-200 for better visibility */
        .level-card .level-icon { background-color: #f0fdf4; color: #059669; }

        /* Active/Selected State */
        .level-card.active {
            transform: translateY(-8px);
        }
        .level-card.active .card-inner {
            background-color: #064e3b !important; /* emerald-900 */
            border-color: #059669 !important; /* emerald-600 */
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.25);
        }
        .level-card.active .level-num { color: white !important; opacity: 0.3 !important; } /* More visible watermark when active */
        .level-card.active .level-title { color: white !important; }
        .level-card.active .level-desc { color: #d1fae5 !important; }
        .level-card.active .level-icon { 
            background-color: #065f46 !important; 
            color: #6ee7b7 !important;
            transform: scale(1.1);
        }
        .level-card.active .level-example-label { color: #34d399 !important; }
        .level-card.active .level-example-box { 
            background-color: rgba(255, 255, 255, 0.1) !important; 
            color: white !important;
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased selection:bg-emerald-600 selection:text-white overflow-x-hidden">

<!-- Navbar -->
<header class="glass-nav fixed top-0 w-full z-50 border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                    <span class="text-white font-bold text-xl">AI</span>
                </div>
                <span class="font-bold text-xl tracking-tight text-gray-900">Score<span class="text-emerald-600">PNJ</span></span>
            </div>
            
            <nav class="hidden md:flex space-x-8">
                <a href="#fitur" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">Fitur</a>
                <a href="#level-aias" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">Level AIAS</a>
                <a href="#cara-kerja" class="text-gray-600 hover:text-emerald-600 font-medium transition-colors">Cara Kerja</a>
            </nav>

            <div class="flex items-center">
                @auth
                    @php
                        $dashboardRoute = 'mahasiswa.dashboard';
                        if (Auth::user()->checkRole('Admin')) $dashboardRoute = 'admin.dashboard';
                        elseif (Auth::user()->checkRole('Dosen')) $dashboardRoute = 'dosen.dashboard';
                    @endphp
                    <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-emerald-800 rounded-full hover:bg-emerald-900 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-800">
                        Dashboard <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white transition-all duration-200 bg-emerald-800 rounded-full hover:bg-emerald-900 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-800">
                        Masuk Portal <i class="fas fa-sign-in-alt ml-2"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#0d2b1a] via-[#1a3d28] to-[#276040] pt-20 pb-32 overflow-hidden border-b border-emerald-900/50">
        <div class="absolute inset-0 bg-grid-pattern opacity-40"></div>
        
        <!-- Glowing accents -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-green-500/20 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10 pt-10">
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-emerald-900/50 border border-emerald-700/50 text-emerald-300 text-sm font-semibold mb-8 shadow-sm">
                <i class="fas fa-shield-alt text-amber-400"></i>
                Portal Asesmen AI Terintegrasi
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-tight text-white">
                AIAS PNJ: <br class="hidden md:block" />
                <span class="gradient-text">Rule-Based Classification</span>
            </h1>
            
            <p class="mt-6 text-xl text-emerald-50 max-w-3xl mx-auto mb-12 leading-relaxed font-light">
                Sistem pendataan dan klasifikasi penggunaan Artificial Intelligence untuk lingkungan akademik Politeknik Negeri Jakarta. Menjaga integritas melalui transparansi dan evaluasi bersistem pakar.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth
                    <a href="{{ route($dashboardRoute) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-amber-950 transition-all duration-300 bg-amber-400 rounded-xl shadow-lg shadow-amber-900/20 hover:bg-amber-300 hover:-translate-y-1">
                        Buka Dashboard <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-amber-950 transition-all duration-300 bg-amber-400 rounded-xl shadow-lg shadow-amber-900/20 hover:bg-amber-300 hover:-translate-y-1">
                        Masuk ke Portal <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                @endauth
                
                @if (Route::has('register') && !Auth::check())
                    <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white transition-all duration-300 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 hover:text-white">
                        Daftar Akun
                    </a>
                @else
                    <a href="#fitur" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white transition-all duration-300 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl hover:bg-white/20 hover:text-white">
                        Pelajari Lebih Lanjut
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-emerald-600 uppercase tracking-widest mb-3">Solusi Inti</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Sistem Cerdas, Transparan, & Terpercaya</h3>
                <p class="text-lg text-gray-600">Menjembatani kesenjangan antara pesatnya penggunaan AI dan regulasi akademik melalui pendekatan sistematis yang modern.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-emerald-100 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-microchip text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Mesin Klasifikasi AIAS</h4>
                    <p class="text-gray-600 leading-relaxed">Secara otomatis menentukan batasan AI Score yang diizinkan untuk setiap kriteria tugas berdasarkan aturan yang ditetapkan.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-emerald-100 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-file-contract text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Deklarasi Mandiri</h4>
                    <p class="text-gray-600 leading-relaxed">Fasilitas terstruktur bagi mahasiswa untuk melaporkan secara jujur sejauh mana penggunaan AI dalam penyelesaian tugas.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-emerald-100 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Pemantauan & Analitik</h4>
                    <p class="text-gray-600 leading-relaxed">Dashboard komprehensif untuk dosen melacak tingkat kepatuhan dan tren penggunaan AI pada setiap kelas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- AIAS Levels Section -->
    <section id="level-aias" class="py-24 bg-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-50 via-emerald-200 to-emerald-50"></div>
        <div class="absolute -right-24 top-24 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-sm font-bold text-emerald-600 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-emerald-600"></span>
                        Framework Klasifikasi
                    </h2>
                    <h3 class="text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                        Eksplorasi <span class="text-emerald-600">Level AIAS</span>
                    </h3>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        Standar klasifikasi penggunaan AI di PNJ yang diadaptasi dari framework akademik global. 
                        Pilih level untuk melihat progres integrasi teknologi.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Standardized by</span>
                    <div class="px-4 py-2 bg-gray-900 text-white rounded-xl text-sm font-semibold shadow-lg shadow-gray-200">
                        Perkins et al., 2025
                    </div>
                </div>
            </div>

            <!-- Progression Indicator (Desktop only) -->
            <div class="hidden md:flex mb-12 items-center px-4">
                <div class="flex-none text-xs font-bold text-emerald-600 uppercase tracking-tighter w-24">Strict Control</div>
                <div class="flex-grow h-2 bg-gray-100 rounded-full mx-4 overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 via-emerald-400 to-amber-400 opacity-20"></div>
                    <div id="progression-bar" class="absolute top-0 left-0 h-full w-1/5 bg-emerald-600 rounded-full shadow-[0_0_10px_rgba(5,150,105,0.5)] transition-all duration-700 ease-in-out"></div>
                </div>
                <div class="flex-none text-xs font-bold text-amber-600 uppercase tracking-tighter w-24 text-right">Full Integration</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <!-- Level 1 -->
                <div onclick="setActiveLevel(1)" class="level-card active relative group h-full cursor-pointer">
                    <div class="card-inner h-full rounded-3xl p-8 flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <div class="level-icon w-12 h-12 rounded-2xl shadow-sm flex items-center justify-center transition-all duration-500">
                                <i class="fas fa-user-edit text-xl"></i>
                            </div>
                            <span class="level-num text-3xl font-black transition-colors">01</span>
                        </div>
                        <h4 class="level-title text-xl font-bold mb-3 transition-colors">No AI</h4>
                        <p class="level-desc text-sm leading-relaxed mb-6 transition-colors">
                            Penyelesaian tugas sepenuhnya tanpa bantuan AI untuk validasi hasil belajar murni.
                        </p>
                        <div class="mt-auto pt-6 border-t border-gray-100/20 level-border transition-colors">
                            <span class="level-example-label text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Contoh Kasus:</span>
                            <p class="level-example-box text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg p-2 transition-all duration-500">
                                Ujian tertutup, refleksi personal, atau tugas di kelas.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 2 -->
                <div onclick="setActiveLevel(2)" class="level-card relative group h-full cursor-pointer">
                    <div class="card-inner h-full rounded-3xl p-8 flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <div class="level-icon w-12 h-12 rounded-2xl shadow-sm flex items-center justify-center transition-all duration-500">
                                <i class="fas fa-lightbulb text-xl"></i>
                            </div>
                            <span class="level-num text-3xl font-black transition-colors">02</span>
                        </div>
                        <h4 class="level-title text-xl font-bold mb-3 transition-colors">AI Planning</h4>
                        <p class="level-desc text-sm leading-relaxed mb-6 transition-colors">
                            AI digunakan terbatas pada tahap brainstorming dan riset awal sebelum pengerjaan.
                        </p>
                        <div class="mt-auto pt-6 border-t border-gray-100/20 level-border transition-colors">
                            <span class="level-example-label text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Contoh Kasus:</span>
                            <p class="level-example-box text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg p-2 transition-all duration-500">
                                Pencarian ide, pembuatan outline, atau riset literatur.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 3 -->
                <div onclick="setActiveLevel(3)" class="level-card relative group h-full cursor-pointer">
                    <div class="card-inner h-full rounded-3xl p-8 flex flex-col relative overflow-hidden">
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div class="level-icon w-12 h-12 rounded-2xl shadow-sm flex items-center justify-center transition-all duration-500">
                                <i class="fas fa-hands-helping text-xl"></i>
                            </div>
                            <span class="level-num text-3xl font-black transition-colors">03</span>
                        </div>
                        <h4 class="level-title text-xl font-bold mb-3 relative z-10 transition-colors">Collaboration</h4>
                        <p class="level-desc text-sm leading-relaxed mb-6 transition-colors relative z-10">
                            Kolaborasi aktif dalam penyusunan draf dan perbaikan teks dengan evaluasi kritis.
                        </p>
                        <div class="mt-auto pt-6 border-t border-gray-100/20 level-border transition-colors relative z-10">
                            <span class="level-example-label text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Contoh Kasus:</span>
                            <p class="level-example-box text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg p-2 transition-all duration-500">
                                Proofreading AI, debugging kode, atau penyempurnaan draf.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 4 -->
                <div onclick="setActiveLevel(4)" class="level-card relative group h-full cursor-pointer">
                    <div class="card-inner h-full rounded-3xl p-8 flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <div class="level-icon w-12 h-12 rounded-2xl shadow-sm flex items-center justify-center transition-all duration-500">
                                <i class="fas fa-robot text-xl"></i>
                            </div>
                            <span class="level-num text-3xl font-black transition-colors">04</span>
                        </div>
                        <h4 class="level-title text-xl font-bold mb-3 transition-colors">Full AI</h4>
                        <p class="level-desc text-sm leading-relaxed mb-6 transition-colors">
                            AI digunakan secara ekstensif untuk mencapai tujuan asesmen yang bersifat kompleks.
                        </p>
                        <div class="mt-auto pt-6 border-t border-gray-100/20 level-border transition-colors">
                            <span class="level-example-label text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Contoh Kasus:</span>
                            <p class="level-example-box text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg p-2 transition-all duration-500">
                                Analisis data besar, otomasi laporan, atau simulasi AI.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 5 -->
                <div onclick="setActiveLevel(5)" class="level-card relative group h-full cursor-pointer">
                    <div class="card-inner h-full rounded-3xl p-8 flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <div class="level-icon w-12 h-12 rounded-2xl shadow-sm flex items-center justify-center transition-all duration-500">
                                <i class="fas fa-flask text-xl"></i>
                            </div>
                            <span class="level-num text-3xl font-black transition-colors">05</span>
                        </div>
                        <h4 class="level-title text-xl font-bold mb-3 transition-colors">AI Exploration</h4>
                        <p class="level-desc text-sm leading-relaxed mb-6 transition-colors">
                            Eksplorasi inovatif melalui ko-desain asesmen untuk aplikasi AI yang unik.
                        </p>
                        <div class="mt-auto pt-6 border-t border-gray-100/20 level-border transition-colors">
                            <span class="level-example-label text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Contoh Kasus:</span>
                            <p class="level-example-box text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg p-2 transition-all duration-500">
                                R&D aplikasi AI baru, seni generatif, atau proyek inovasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile hint -->
            <div class="mt-12 text-center md:hidden">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest animate-pulse">Pilih kartu untuk detail</span>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="py-24 bg-white relative overflow-hidden border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Alur Kerja Sistem</h2>
                <p class="text-lg text-gray-600">Sederhana, terarah, dan mengutamakan transparansi antara dosen dan mahasiswa.</p>
            </div>

            <div class="relative">
                <div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-gray-200 z-0"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    <div class="text-center group">
                        <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-6 shadow-lg border-4 border-white ring-1 ring-gray-100 group-hover:ring-emerald-300 transition-all">
                            <span class="text-3xl font-black text-emerald-800">1</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Input Kriteria</h4>
                        <p class="text-gray-600 px-4">Dosen membuat tugas dan menetapkan kriteria serta parameter penilaian ke dalam sistem.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-24 h-24 mx-auto bg-emerald-600 rounded-full flex items-center justify-center mb-6 shadow-lg shadow-emerald-200 border-4 border-white transform group-hover:scale-105 transition-all">
                            <span class="text-3xl font-black text-white">2</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Klasifikasi AI</h4>
                        <p class="text-gray-600 px-4">Mesin aturan memproses kriteria dan menghasilkan batas maksimal tingkat AI yang diizinkan.</p>
                    </div>
                    <div class="text-center group">
                        <div class="w-24 h-24 mx-auto bg-gray-900 rounded-full flex items-center justify-center mb-6 shadow-lg border-4 border-white group-hover:bg-gray-800 transition-all">
                            <span class="text-3xl font-black text-white">3</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Deklarasi Mahasiswa</h4>
                        <p class="text-gray-600 px-4">Mahasiswa mengerjakan tugas dan mengisi form deklarasi penggunaan AI sebelum pengumpulan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-[#0a2013] text-white py-12 border-t border-emerald-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex justify-center items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center">
                <span class="text-white font-bold text-sm">AI</span>
            </div>
            <span class="font-bold text-xl tracking-tight text-white">Score<span class="text-emerald-400">PNJ</span></span>
        </div>
        <p class="text-emerald-500/60 text-sm mb-6">© {{ date('Y') }} Portal Asesmen AI PNJ. Hak Cipta Dilindungi.</p>
        <div class="flex justify-center gap-6">
            <a href="#" class="text-emerald-500/60 hover:text-emerald-300 transition-colors text-xs uppercase tracking-widest font-bold">Privasi</a>
            <a href="#" class="text-emerald-500/60 hover:text-emerald-300 transition-colors text-xs uppercase tracking-widest font-bold">Syarat</a>
        </div>
    </div>
</footer>

<script>
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('header');
        if (window.scrollY > 10) {
            nav.classList.add('shadow-lg');
            nav.classList.add('border-emerald-800/50');
        } else {
            nav.classList.remove('shadow-lg');
            nav.classList.remove('border-emerald-800/50');
        }
    });

    // AIAS Level Interactivity
    function setActiveLevel(level) {
        // Update cards
        const cards = document.querySelectorAll('.level-card');
        cards.forEach((card, index) => {
            if (index + 1 === level) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });

        // Update progression bar
        const progressBar = document.getElementById('progression-bar');
        const percentage = (level / 5) * 100;
        progressBar.style.width = `${percentage}%`;

        // Update progression bar color based on level
        if (level <= 2) {
            progressBar.style.backgroundColor = '#059669'; // emerald-600
        } else if (level <= 4) {
            progressBar.style.backgroundColor = '#10b981'; // emerald-500
        } else {
            progressBar.style.backgroundColor = '#f59e0b'; // amber-500
        }
    }
</script>

</body>
</html>
