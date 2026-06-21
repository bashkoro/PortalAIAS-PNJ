<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Deklarasi Penggunaan AI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #10b981;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #047857;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #6b7280;
        }
        .section-title {
            background-color: #ecfdf5;
            color: #047857;
            padding: 5px 10px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-left: 4px solid #10b981;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th, table td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        table th {
            background-color: #f3f4f6;
            width: 30%;
        }
        .prompt-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .prompt-title {
            font-weight: bold;
            color: #374151;
            margin-bottom: 5px;
        }
        .text-green { color: #10b981; }
        .text-red { color: #ef4444; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Deklarasi Penggunaan AI (AIAS)</h1>
        <p>Portal Asesmen AI - Politeknik Negeri Jakarta</p>
    </div>

    <div class="section-title">Informasi Mahasiswa & Tugas</div>
    <table>
        <tr>
            <th>Nama Mahasiswa</th>
            <td>{{ $deklarasi->mahasiswa->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Mata Kuliah / Kelas</th>
            <td>{{ $deklarasi->tugas->kelasKuliah->mataKuliah->nama_mk ?? '-' }} / {{ $deklarasi->tugas->kelasKuliah->nama_kelas ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tugas</th>
            <td>{{ $deklarasi->tugas->judul ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tingkat AIAS</th>
            <td>{{ $deklarasi->tingkatAias->nama_tingkat ?? ($deklarasi->tugas->tingkatAiasAkhir->nama_tingkat ?? 'Tidak Spesifik') }}</td>
        </tr>
        <tr>
            <th>Waktu Pengumpulan</th>
            <td>{{ $deklarasi->waktu_pengumpulan ? \Carbon\Carbon::parse($deklarasi->waktu_pengumpulan)->format('d F Y H:i') : '-' }}</td>
        </tr>
        <tr>
            <th>Lampiran Bukti Fisik</th>
            <td>
                @if($deklarasi->path_file_bukti)
                    Terlampir di Sistem ({{ basename($deklarasi->path_file_bukti) }})
                @else
                    Tidak ada lampiran
                @endif
            </td>
        </tr>
    </table>



    <div class="section-title">Rincian Penggunaan AI (Riwayat Prompt)</div>
    @if($deklarasi->riwayatPrompt && $deklarasi->riwayatPrompt->count() > 0)
        @foreach($deklarasi->riwayatPrompt as $index => $prompt)
            <div class="prompt-box">
                <div class="prompt-title">{{ $index + 1 }}. Platform AI: {{ $prompt->nama_platform_ai ?? '-' }}</div>
                <p><strong>Prompt yang dikirim:</strong><br>
                {{ $prompt->prompt_dikirim ?? '-' }}</p>
                <p><strong>Ringkasan Respons:</strong><br>
                {{ $prompt->respons_ai ?? '-' }}</p>
                @if($prompt->link_conversation)
                <p><strong>Link Conversation:</strong><br>
                <a href="{{ $prompt->link_conversation }}">{{ $prompt->link_conversation }}</a></p>
                @endif
            </div>
        @endforeach
    @else
        <p>Tidak ada riwayat penggunaan prompt atau tools AI yang dideklarasikan oleh mahasiswa.</p>
    @endif

</body>
</html>
