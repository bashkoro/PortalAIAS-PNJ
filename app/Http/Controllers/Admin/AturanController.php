<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use App\Models\TingkatAias;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    private $kriteriaOptions = [
        'lingkungan_pengerjaan' => ['Terbuka / Tanpa Pengawasan', 'Terkendali Penuh / Terawasi'],
        'tingkat_proses_kognitif' => ['Mengingat (Remembering)', 'Memahami (Understanding)', 'Mengaplikasikan (Applying)', 'Menganalisis (Analyzing)', 'Mengevaluasi (Evaluating)', 'Mencipta (Creating)'],
        'dimensi_pengetahuan' => ['Pengetahuan Faktual', 'Pengetahuan Konseptual', 'Pengetahuan Prosedural', 'Pengetahuan Metakognitif'],
        'struktur_kompleksitas_respons' => ['Prastruktural', 'Unistruktural', 'Multistruktural', 'Relasional', 'Abstrak Diperluas (Extended Abstract)'],
        'tingkat_keaslian_konteks' => ['Dekontekstualisasi / Tradisional', 'Simulasi / Terapan', 'Otentik / Dunia Nyata'],
        'fokus_evaluasi' => ['Asesmen Produk', 'Asesmen Proses', 'Asesmen Dialogis'],
    ];

    public function index(Request $request)
    {
        $search = $request->query('search');
        $levelId = $request->query('tingkat_aias_id');

        $aturan = Aturan::with(['kondisiAturan', 'tingkatAias'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('kondisiAturan', function($q) use ($search) {
                    $q->where('target_value', 'ilike', '%' . $search . '%');
                });
            })
            ->when($levelId, function ($query, $levelId) {
                return $query->where('tingkat_aias_id', $levelId);
            })
            ->orderBy('id', 'asc')
            ->paginate(15)
            ->appends($request->query());

        $levels = TingkatAias::orderBy('id')->get();

        return view('admin.rules.index', compact('aturan', 'levels'));
    }

    public function create()
    {
        $levels = TingkatAias::orderBy('id')->get();
        $kriteriaOptions = $this->kriteriaOptions;
        
        return view('admin.rules.create', compact('levels', 'kriteriaOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat_aias_id' => 'required|exists:tingkat_aias,id',
            'kondisi' => 'required|array',
        ]);

        $formattedKondisi = [];
        foreach ($request->kondisi as $key => $value) {
            if (!empty($value)) {
                $formattedKondisi[] = [
                    'nama_parameter' => $key,
                    'operator' => '=',
                    'target_value' => $value
                ];
            }
        }

        $aturanModel = new Aturan();
        
        if ($aturanModel->checkConflict($formattedKondisi)) {
            return back()->withInput()->withErrors(['aturan' => 'Konflik dengan aturan yang sudah ada. Coba kombinasi kriteria lain.']);
        }

        $dataToSave = $request->all();
        $dataToSave['kondisi'] = $formattedKondisi;

        if ($aturanModel->saveRule($dataToSave)) {
            return redirect()->route('admin.rules.index')->with('success', 'Aturan berhasil disimpan.');
        }

        return back()->withInput()->withErrors(['aturan' => 'Gagal menyimpan aturan.']);
    }

    public function edit(Aturan $rule)
    {
        $levels = TingkatAias::orderBy('id')->get();
        $kriteriaOptions = $this->kriteriaOptions;
        
        // Bentuk data kondisi menjadi array key-value untuk mempermudah form
        $kondisiCurrent = [];
        foreach ($rule->kondisiAturan as $kondisi) {
            $kondisiCurrent[$kondisi->nama_parameter] = $kondisi->target_value;
        }

        return view('admin.rules.edit', compact('rule', 'levels', 'kriteriaOptions', 'kondisiCurrent'));
    }

    public function update(Request $request, Aturan $rule)
    {
        $request->validate([
            'tingkat_aias_id' => 'required|exists:tingkat_aias,id',
            'kondisi' => 'required|array',
        ]);

        $formattedKondisi = [];
        foreach ($request->kondisi as $key => $value) {
            if (!empty($value)) {
                $formattedKondisi[] = [
                    'nama_parameter' => $key,
                    'operator' => '=',
                    'target_value' => $value
                ];
            }
        }

        // Simpan kondisi lama untuk di-restore jika konflik
        $oldKondisi = $rule->kondisiAturan->toArray();

        // Hapus sementara kondisi aturan saat ini agar tidak terdeteksi konflik dengan dirinya sendiri
        $rule->kondisiAturan()->delete();

        $aturanModel = new Aturan();
        
        if ($aturanModel->checkConflict($formattedKondisi)) {
            // Restore kondisi karena ada konflik
            foreach ($oldKondisi as $kondisi) {
                $rule->kondisiAturan()->create([
                    'nama_parameter' => $kondisi['nama_parameter'],
                    'operator' => $kondisi['operator'],
                    'target_value' => $kondisi['target_value']
                ]);
            }
            return back()->withInput()->withErrors(['aturan' => 'Konflik dengan aturan yang sudah ada. Coba kombinasi kriteria lain.']);
        }

        $rule->tingkat_aias_id = $request->tingkat_aias_id;
        $rule->save();

        foreach ($formattedKondisi as $kondisi) {
            $rule->kondisiAturan()->create($kondisi);
        }

        return redirect()->route('admin.rules.index')->with('success', 'Aturan berhasil diperbarui.');
    }

    public function destroy(Aturan $rule)
    {
        $rule->is_active = !$rule->is_active; // Toggle status
        $rule->save();
        
        $status = $rule->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.rules.index')->with('success', "Aturan berhasil {$status}.");
    }
}
