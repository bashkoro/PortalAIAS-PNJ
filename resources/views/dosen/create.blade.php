@extends('layouts.dosen')

@section('title', 'Buat Penugasan Baru')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
@endpush

@section('content')
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="javascript:history.back()" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm" role="alert">
                <p class="font-bold">Gagal Menyimpan Tugas</p>
                <ul class="list-disc ml-5 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="task-form" action="{{ route('dosen.tugas.store') }}" method="POST" class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
            @csrf
            
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                <h3 class="font-bold text-gray-800 text-lg">Informasi Tugas & Kriteria Asesmen</h3>
                <p class="text-sm text-gray-500">Lengkapi detail dasar tugas beserta kriteria klasifikasi AI-nya.</p>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="kelas_kuliah_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kelas Mata Kuliah <span class="text-red-500">*</span></label>
                    <select name="kelas_kuliah_id" id="kelas_kuliah_id" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasKuliah as $kelas)
                            <option value="{{ $kelas->id }}" {{ (old('kelas_kuliah_id') == $kelas->id || request('kelas_id') == $kelas->id) ? 'selected' : '' }}>
                                {{ $kelas->mataKuliah->nama_mk }} - {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Tugas <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Contoh: Makalah Analisis Algoritma" required>
                </div>
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi/Instruksi Tugas <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Tuliskan instruksi pengerjaan tugas secara detail di sini..." required>{{ old('deskripsi') }}</textarea>
                </div>
                
                <hr class="border-gray-200">
                <h4 class="font-bold text-gray-800 text-md mb-2">Karakteristik Asesmen/Tugas</h4>
                <div class="grid grid-cols-1 gap-6">
                    <!-- Lingkungan Pengerjaan -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Lingkungan Pengerjaan <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Keterangan:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Terbuka:</strong> Tugas dikerjakan tanpa pengawasan langsung, bebas mengakses berbagai sumber (internet, buku, dll).</li>
                                        <li><strong>Terkendali Penuh:</strong> Tugas dikerjakan dalam lingkungan yang diawasi ketat (misal: di kelas, menggunakan safe exam browser).</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="lingkungan_pengerjaan" name="kriteria_tugas[lingkungan_pengerjaan]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">-- Pilih Lingkungan Pengerjaan --</option>
                            @foreach($kriteriaOptions['lingkungan_pengerjaan'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.lingkungan_pengerjaan') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tingkat Proses Kognitif -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Tingkat Proses Kognitif <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Tingkat Proses Kognitif:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Mengingat:</strong> Mahasiswa hanya diminta mengingat fakta, teori, atau konsep dasar.</li>
                                        <li><strong>Memahami:</strong> Mahasiswa diminta menjelaskan suatu konsep dengan kalimatnya sendiri.</li>
                                        <li><strong>Mengaplikasikan:</strong> Mahasiswa menggunakan informasi atau rumus pada situasi studi kasus baru.</li>
                                        <li><strong>Menganalisis:</strong> Mahasiswa memecah informasi kompleks untuk melihat pola atau hubungannya.</li>
                                        <li><strong>Mengevaluasi:</strong> Mahasiswa memberikan penilaian, kritik, atau justifikasi berdasarkan standar tertentu.</li>
                                        <li><strong>Mencipta:</strong> Mahasiswa merancang, membangun, atau menghasilkan produk/ide baru yang orisinal.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="tingkat_proses_kognitif" name="kriteria_tugas[tingkat_proses_kognitif]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent kognitif-select" required>
                            <option value="">-- Pilih Tingkat Proses Kognitif --</option>
                            @foreach($kriteriaOptions['tingkat_proses_kognitif'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.tingkat_proses_kognitif') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Aktivitas Pembelajaran -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700" for="aktivitas_pembelajaran">Aktivitas Pembelajaran <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Panduan Opsi:</p>
                                    <p>Bentuk aktivitas spesifik ini akan menyesuaikan dengan Tingkat Proses Kognitif yang Anda pilih sebelumnya.</p>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="aktivitas_pembelajaran" name="aktivitas_pembelajaran" class="w-full bg-white border border-gray-300 text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                            <option value="">Pilih Tingkat Kognitif Terlebih Dahulu</option>
                        </select>
                    </div>
                    <!-- Dimensi Pengetahuan -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Jenis Target Pengetahuan <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Dimensi Pengetahuan:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Pengetahuan Faktual:</strong> Detail spesifik, istilah, atau elemen dasar yang harus dihafal.</li>
                                        <li><strong>Pengetahuan Konseptual:</strong> Klasifikasi, teori, model, atau struktur antar gagasan.</li>
                                        <li><strong>Pengetahuan Prosedural:</strong> Pengetahuan tentang metode, langkah-langkah, atau cara melakukan sesuatu.</li>
                                        <li><strong>Pengetahuan Metakognitif:</strong> Kesadaran personal tentang bagaimana diri sendiri belajar, pemaknaan pengalaman pribadi, dan refleksi diri.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="dimensi_pengetahuan" name="kriteria_tugas[dimensi_pengetahuan]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">-- Pilih Jenis Target Pengetahuan --</option>
                            @foreach($kriteriaOptions['dimensi_pengetahuan'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.dimensi_pengetahuan') == $option ? 'selected' : '' }}>
                                    @if($option == 'Pengetahuan Faktual') Fakta & Data Spesifik
                                    @elseif($option == 'Pengetahuan Konseptual') Teori & Model Konsep
                                    @elseif($option == 'Pengetahuan Prosedural') Langkah Kerja & Praktik
                                    @elseif($option == 'Pengetahuan Metakognitif') Refleksi Diri & Pengalaman
                                    @else {{ $option }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Struktur Kompleksitas Respons -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Kompleksitas Jawaban <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Struktur Kompleksitas Respons:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Prastruktural:</strong> Jawaban tidak relevan, tidak terarah, atau salah.</li>
                                        <li><strong>Unistruktural:</strong> Fokus pada satu aspek tunggal yang relevan.</li>
                                        <li><strong>Multistruktural:</strong> Fokus pada beberapa aspek terpisah, belum ada hubungan.</li>
                                        <li><strong>Relasional:</strong> Mengintegrasikan berbagai aspek menjadi sebuah kesatuan yang saling terhubung.</li>
                                        <li><strong>Abstrak Diperluas:</strong> Mampu menggeneralisasi atau menerapkan prinsip ke dalam konteks baru.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="struktur_kompleksitas_respons" name="kriteria_tugas[struktur_kompleksitas_respons]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">-- Pilih Kompleksitas Jawaban --</option>
                            @foreach($kriteriaOptions['struktur_kompleksitas_respons'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.struktur_kompleksitas_respons') == $option ? 'selected' : '' }}>
                                    @if($option == 'Prastruktural') Sangat Dasar
                                    @elseif($option == 'Unistruktural') Fokus Satu Aspek
                                    @elseif($option == 'Multistruktural') Pemaparan Banyak Fakta
                                    @elseif($option == 'Relasional') Analisis Keterkaitan Konsep
                                    @elseif($option == 'Abstrak Diperluas') Pengembangan Konsep Baru
                                    @else {{ $option }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Konteks & Skenario Tugas -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Konteks & Skenario Tugas <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Keterangan:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Teori Murni / Konseptual:</strong> Tugas bersifat teoritis abstrak, akademis murni, dan tidak terikat pada situasi dunia nyata.</li>
                                        <li><strong>Simulasi / Studi Kasus Buatan:</strong> Tugas menggunakan skenario pura-pura yang meniru kondisi lingkungan kerja.</li>
                                        <li><strong>Proyek Lapangan / Industri Nyata:</strong> Tugas mewajibkan mahasiswa turun lapangan, mencari data primer, atau memecahkan krisis nyata dari pemangku kepentingan industri.</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="tingkat_keaslian_konteks" name="kriteria_tugas[tingkat_keaslian_konteks]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">-- Pilih Konteks & Skenario --</option>
                            @foreach($kriteriaOptions['tingkat_keaslian_konteks'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.tingkat_keaslian_konteks') == $option ? 'selected' : '' }}>
                                    @if($option == 'Dekontekstualisasi / Tradisional') Teori Murni / Konseptual
                                    @elseif($option == 'Simulasi / Terapan') Simulasi / Studi Kasus Buatan
                                    @elseif($option == 'Otentik / Dunia Nyata') Proyek Lapangan / Industri Nyata
                                    @else {{ $option }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Fokus Penilaian -->
                    <div>
                        <div class="flex items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Fokus Penilaian <span class="text-red-500">*</span></label>
                            <div class="relative group ml-2 flex items-center">
                                <i class="fas fa-question-circle text-gray-400 hover:text-blue-600 cursor-help transition-colors"></i>
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block w-72 p-3 bg-gray-800 text-white text-xs rounded-lg shadow-xl z-50 transition-opacity">
                                    <p class="font-semibold mb-1 border-b border-gray-600 pb-1">Fokus Penilaian:</p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li><strong>Penilaian Hasil Akhir:</strong> Nilai murni dari dokumen atau karya yang dikumpulkan (contoh: laporan akhir, kode jadi, atau esai).</li>
                                        <li><strong>Penilaian Proses Pengerjaan:</strong> Nilai mencakup pemantauan langkah pembuatan (contoh: logbook, draf, riwayat revisi, atau riwayat prompt AI).</li>
                                        <li><strong>Penilaian Lisan / Presentasi:</strong> Penilaian dilakukan lewat interaksi langsung (contoh: presentasi kelas, tanya jawab, atau sidang).</li>
                                    </ul>
                                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <select id="fokus_evaluasi" name="kriteria_tugas[fokus_evaluasi]" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">-- Pilih Fokus Penilaian --</option>
                            @foreach($kriteriaOptions['fokus_evaluasi'] as $option)
                                <option value="{{ $option }}" {{ old('kriteria_tugas.fokus_evaluasi') == $option ? 'selected' : '' }}>
                                    @if($option == 'Asesmen Produk') Penilaian Hasil Akhir
                                    @elseif($option == 'Asesmen Proses') Penilaian Proses Pengerjaan
                                    @elseif($option == 'Asesmen Dialogis') Penilaian Lisan / Presentasi
                                    @else {{ $option }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
                    <p class="text-sm text-blue-700"><strong>Penting:</strong> Setelah Anda menyimpan, Mesin Inferensi akan secara otomatis mengevaluasi kombinasi kriteria di atas and menetapkan Tingkat AI Score yang diizinkan untuk tugas ini.</p>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-end gap-3">
                <button type="submit" name="action" value="draft" class="px-5 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                    Simpan Draft
                </button>
                <button type="submit" name="action" value="publish" class="px-5 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-blue-700 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-check-circle mr-2"></i> Simpan & Klasifikasi AI Score
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const activityMapping = {
                'Mengingat (Remembering)': [
                    'Kuis Pilihan Ganda', 'Menjawab Singkat', 'Flashcards / Menghafal Istilah', 'Review Materi Bacaan'
                ],
                'Memahami (Understanding)': [
                    'Penulisan Esai', 'Peta Konsep', 'Pembuatan Ringkasan', 'Infografis'
                ],
                'Mengaplikasikan (Applying)': [
                    'Eksperimen Laboratorium', 'Laporan Praktikum', 'Tugas Pemecahan Masalah', 'Perhitungan Matematis', 'Presentasi'
                ],
                'Menganalisis (Analyzing)': [
                    'Studi Kasus', 'Makalah Analisis', 'Penulisan Makalah Riset', 'Debat', 'Investigasi Kelompok'
                ],
                'Mengevaluasi (Evaluating)': [
                    'Esai Argumentatif', 'Kritik Jurnal / Review Paper', 'Pembuatan Jurnal Refleksi', 'Laporan Evaluasi'
                ],
                'Mencipta (Creating)': [
                    'Proyek Desain', 'Proposal Riset', 'Proyek Akhir / Penelitian', 'Pembuatan Solusi Alternatif'
                ]
            };

            const aktivitasSelect = new TomSelect('#aktivitas_pembelajaran', {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: 'Pilih Tingkat Kognitif Terlebih Dahulu',
            });
            
            aktivitasSelect.disable();

            const kognitifSelect = document.querySelector('.kognitif-select');
            
            function updateAktivitasDropdown(selectedValue, maintainOldValue = false) {
                aktivitasSelect.clear();
                aktivitasSelect.clearOptions();
                
                if (activityMapping[selectedValue]) {
                    aktivitasSelect.enable();
                    aktivitasSelect.settings.placeholder = 'Pilih Aktivitas Pembelajaran';
                    aktivitasSelect.inputState();
                    
                    const options = activityMapping[selectedValue].map(activity => ({
                        value: activity,
                        text: activity
                    }));
                    
                    aktivitasSelect.addOptions(options);

                    // For validation errors reload, check if there was a previous selection
                    if (maintainOldValue) {
                        const oldAktivitas = "{{ old('aktivitas_pembelajaran') }}";
                        if (oldAktivitas) {
                            aktivitasSelect.setValue(oldAktivitas);
                        }
                    }
                } else {
                    aktivitasSelect.disable();
                    aktivitasSelect.settings.placeholder = 'Pilih Tingkat Kognitif Terlebih Dahulu';
                    aktivitasSelect.inputState();
                }
            }

            if (kognitifSelect) {
                kognitifSelect.addEventListener('change', (e) => {
                    updateAktivitasDropdown(e.target.value);
                });
                
                // Initial state based on old() values
                if (kognitifSelect.value) {
                    updateAktivitasDropdown(kognitifSelect.value, true);
                }
            }
        });
    </script>
@endpush
