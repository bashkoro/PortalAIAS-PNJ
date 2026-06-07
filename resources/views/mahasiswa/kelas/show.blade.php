@extends('layouts.mahasiswa')

@section('title', "Kelas {$kelas->nama_kelas}")

@section('content')
    <div class="mb-6">
        <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center">
                <div class="h-16 w-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-indigo-100 mr-6 shrink-0 uppercase font-bold">
                    {{ substr($kelas->nama_kelas, 0, 2) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 uppercase">Kelas {{ $kelas->nama_kelas }}</h2>
                    <p class="text-gray-500 font-medium">{{ $kelas->mataKuliah->nama_mk }} ({{ $kelas->mataKuliah->kode_mk }})</p>
                    <div class="flex flex-wrap gap-3 mt-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                            <i class="fas fa-graduation-cap mr-1.5 opacity-60"></i> {{ $kelas->mataKuliah->programStudi->nama_prodi }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase">
                            <i class="fas fa-user-tie mr-1.5 opacity-60"></i> {{ $kelas->dosen->nama ?? 'Belum Ada Dosen' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assignments Section -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-tasks text-indigo-600"></i> Daftar Penugasan
        </h3>

        @if($tugas->isEmpty())
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-12 text-center">
                <div class="mx-auto w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4 border border-gray-100">
                    <i class="fas fa-folder-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada penugasan</h3>
                <p class="text-gray-500 max-w-sm mx-auto">Dosen Anda belum mempublikasikan tugas apa pun untuk kelas ini.</p>
            </div>
        @else
            <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white text-left">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase font-semibold border-b border-gray-200">
                            <tr>
                                <th class="py-3 px-6 w-16 text-center">No</th>
                                <th class="py-3 px-6">Judul Tugas</th>
                                <th class="py-3 px-6 text-center">Kebijakan AI</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                            @foreach($tugas as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 text-center text-gray-500 font-mono text-xs">{{ $index + 1 }}</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-900">{{ $item->judul }}</div>
                                    <div class="text-[11px] text-gray-500 mt-0.5 line-clamp-1">{{ Str::limit($item->deskripsi, 80) }}</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($item->tingkatAiasAkhir)
                                        @php
                                            $level = $item->tingkatAiasAkhir->nama_tingkat;
                                            $colorClass = 'bg-gray-100 text-gray-800';
                                            if (str_contains($level, '1')) $colorClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                            elseif (str_contains($level, '2')) $colorClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                            elseif (str_contains($level, '3')) $colorClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                            elseif (str_contains($level, '4')) $colorClass = 'bg-indigo-50 text-indigo-700 border-indigo-100';
                                            elseif (str_contains($level, '5')) $colorClass = 'bg-rose-50 text-rose-700 border-rose-100';
                                        @endphp
                                        <span class="{{ $colorClass }} py-1 px-3 rounded text-[11px] font-bold border uppercase tracking-wide inline-block min-w-[70px]" title="{{ $item->tingkatAiasAkhir->deskripsi }}">
                                            {{ $level }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic text-xs">N/A</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if(in_array($item->id, $declared_tugas_ids))
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                            <i class="fas fa-check-circle mr-1.5"></i> Sudah Deklarasi
                                        </span>
                                    @else
                                        <a href="{{ route('mahasiswa.deklarasi.create', ['tugas_id' => $item->id]) }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-bold py-2 px-4 rounded-lg shadow-sm transition-all shadow-indigo-100">
                                            <i class="fas fa-edit mr-2"></i> Deklarasi AI
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

@endsection
