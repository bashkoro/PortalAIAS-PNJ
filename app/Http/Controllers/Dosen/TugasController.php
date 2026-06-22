<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\KelasKuliah;
use App\Models\Deklarasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TugasController extends Controller
{
    public function dashboard()
    {
        $dosenId = Auth::id();
        
        $tugas = Tugas::with(['tingkatAiasAkhir', 'deklarasi'])
            ->whereHas('kelasKuliah', function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId);
            })
            ->get();

        $totalPenugasan = $tugas->count();
        $tugasAktif = $tugas->where('status_publikasi', 'Published')->count();
        
        $tugasTerpublikasi = $tugas->where('status_publikasi', 'Published');
        
        // Menghitung "Tren Kebijakan AI" (Level AIAS yang paling sering digunakan)
        $trenKebijakanAI = 'N/A';
        if ($tugasTerpublikasi->count() > 0) {
            $levelCounts = $tugasTerpublikasi->groupBy('tingkat_aias_akhir_id')->map->count();
            $mostFrequentLevelId = $levelCounts->sortDesc()->keys()->first();
            
            // Mendapatkan nama level berdasarkan ID dari relasi yang dimuat untuk menghindari query tambahan jika memungkinkan, 
            // namun untuk keamanan, kita mencari tugas pertama dengan ID ini.
            $sampleTask = $tugasTerpublikasi->firstWhere('tingkat_aias_akhir_id', $mostFrequentLevelId);
            if ($sampleTask && $sampleTask->tingkatAiasAkhir) {
                $trenKebijakanAI = $sampleTask->tingkatAiasAkhir->nama_tingkat;
            } else {
                $trenKebijakanAI = 'Level ' . $mostFrequentLevelId;
            }
        }
        
        $deklarasiMasuk = $tugas->sum(function ($t) {
            return collect($t->deklarasi)->count();
        });

        $tugasTerbaru = Tugas::with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])
            ->whereHas('kelasKuliah', function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId);
            })
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('dosen.dashboard', compact('totalPenugasan', 'tugasAktif', 'trenKebijakanAI', 'deklarasiMasuk', 'tugasTerbaru'));
    }

    public function showDeclarations($taskId)
    {
        $dosenId = Auth::id();
        
        // Pastikan tugas ini milik dosen yang login
        $tugas = Tugas::with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])
            ->whereHas('kelasKuliah', function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId);
            })
            ->findOrFail($taskId);

        $deklarasi = \App\Models\Deklarasi::with('mahasiswa')
            ->where('tugas_id', $taskId)
            ->orderBy('waktu_pengumpulan', 'desc')
            ->get();

        return view('dosen.detailriwayat', compact('tugas', 'deklarasi'));
    }

    public function downloadPdf($id)
    {
        $deklarasi = Deklarasi::with([
            'mahasiswa', 
            'tugas.kelasKuliah.mataKuliah', 
            'riwayatPrompt', 
            'tingkatAias'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('dosen.pdf_deklarasi', compact('deklarasi'));
        $pdf->setPaper('A4', 'portrait');

        $namaMahasiswa = str_replace(' ', '_', $deklarasi->mahasiswa->nama ?? 'Mahasiswa');
        $fileName = 'Deklarasi_AIAS_' . $namaMahasiswa . '.pdf';

        return $pdf->download($fileName);
    }

    public function index()
    {
        $dosenId = Auth::id();
        $tugas = Tugas::with(['kelasKuliah.mataKuliah', 'tingkatAiasAkhir'])
            ->whereHas('kelasKuliah', function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId);
            })
            ->orderBy('id', 'desc')
            ->get();
            
        return view('dosen.riwayat', compact('tugas'));
    }

    public function create()
    {
        $dosenId = Auth::id();
        $kelasKuliah = KelasKuliah::with('mataKuliah')
            ->where('dosen_id', $dosenId)
            ->get();

        // Opsi kriteria hardcode berdasarkan AturanSeeder
        $kriteriaOptions = [
            'lingkungan_pengerjaan' => ['Terbuka / Tanpa Pengawasan', 'Terkendali Penuh / Terawasi'],
            'tingkat_proses_kognitif' => ['Mengingat (Remembering)', 'Memahami (Understanding)', 'Mengaplikasikan (Applying)', 'Menganalisis (Analyzing)', 'Mengevaluasi (Evaluating)', 'Mencipta (Creating)'],
            'dimensi_pengetahuan' => ['Pengetahuan Faktual', 'Pengetahuan Konseptual', 'Pengetahuan Prosedural', 'Pengetahuan Metakognitif'],
            'struktur_kompleksitas_respons' => ['Prastruktural', 'Unistruktural', 'Multistruktural', 'Relasional', 'Abstrak Diperluas (Extended Abstract)'],
            'tingkat_keaslian_konteks' => ['Dekontekstualisasi / Tradisional', 'Simulasi / Terapan', 'Otentik / Dunia Nyata'],
            'fokus_evaluasi' => ['Asesmen Produk', 'Asesmen Proses', 'Asesmen Dialogis'],
        ];

        return view('dosen.create', compact('kelasKuliah', 'kriteriaOptions'));
    }

    public function evaluateRules(array $criteria): ?int
    {
        $tugas = new Tugas();
        return $tugas->calculateAIScore($criteria);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_kuliah_id' => 'required|exists:kelas_kuliah,id',
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'kriteria_tugas' => 'required|array',
            'action' => 'required|in:draft,publish'
        ]);

        $scoreId = $this->evaluateRules($request->kriteria_tugas);
        
        if ($scoreId === null) {
             return back()->withInput()->withErrors(['kriteria' => 'Kriteria yang dipilih tidak cocok dengan Aturan Klasifikasi AI Score mana pun dalam Knowledge Base. Silakan sesuaikan kombinasi kriteria.']);
        }

        $tugas = new Tugas();
        $tugas->kelas_kuliah_id = $request->kelas_kuliah_id;
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->kriteria_tugas = $request->kriteria_tugas;
        $tugas->tingkat_aias_akhir_id = $scoreId;

        if ($request->action === 'draft') {
            $tugas->saveAsDraft();
            $message = 'Tugas berhasil disimpan sebagai Draft.';
        } else {
            $tugas->publishTask();
            $message = 'Tugas berhasil dipublikasikan dan skor AIAS telah ditetapkan.';
        }

        return redirect()->route('dosen.riwayat')->with('success', $message);
    }
}
