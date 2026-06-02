<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TingkatAias extends Model
{
    protected $table = 'tingkat_aias';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function aturan(): HasMany
    {
        return $this->hasMany(Aturan::class);
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class, 'tingkat_aias_akhir_id');
    }
}
