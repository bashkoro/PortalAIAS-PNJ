<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Aturan extends Model
{
    protected $table = 'aturan';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tingkatAias(): BelongsTo
    {
        return $this->belongsTo(TingkatAias::class);
    }

    public function kondisiAturan(): HasMany
    {
        return $this->hasMany(KondisiAturan::class);
    }

    public function logAuditAturan(): HasMany
    {
        return $this->hasMany(LogAuditAturan::class);
    }

    public static function getActiveRules(): \Illuminate\Database\Eloquent\Collection
    {
        return self::with('kondisiAturan')->where('is_active', true)->get();
    }

    public function checkConflict(array $rules): bool
    {
        // Logika untuk memeriksa apakah aturan baru bertentangan dengan aturan aktif yang ada
        $activeRules = self::getActiveRules();

        foreach ($activeRules as $activeRule) {
            $existingConditions = $activeRule->kondisiAturan->map(function ($k) {
                return $k->nama_parameter . $k->operator . $k->target_value;
            })->sort()->values()->toArray();

            $newConditions = collect($rules)->map(function ($r) {
                return $r['nama_parameter'] . $r['operator'] . $r['target_value'];
            })->sort()->values()->toArray();

            if ($existingConditions === $newConditions) {
                return true; // Ditemukan konflik
            }
        }

        return false;
    }

    public function saveRule(array $data): bool
    {
        // Contoh implementasi sederhana, asumsikan $data berisi info aturan dan kondisi
        DB::beginTransaction();
        try {
            $this->tingkat_aias_id = $data['tingkat_aias_id'];
            $this->is_active = $data['is_active'] ?? true;
            $this->save();

            if (isset($data['kondisi']) && is_array($data['kondisi'])) {
                $this->kondisiAturan()->delete(); // Hapus kondisi yang ada jika ada
                foreach ($data['kondisi'] as $kondisi) {
                    $this->kondisiAturan()->create($kondisi);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
