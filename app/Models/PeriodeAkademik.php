<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeriodeAkademik extends Model
{
    protected $table = 'periode_akademik';
    public $timestamps = false;
    protected $fillable = ['nama_periode', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function kelasKuliah(): HasMany
    {
        return $this->hasMany(KelasKuliah::class);
    }
}
