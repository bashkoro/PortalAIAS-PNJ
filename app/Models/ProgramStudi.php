<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    public $timestamps = false;
    protected $fillable = ['kode_prodi', 'nama_prodi'];

    public function pengguna(): HasMany
    {
        return $this->hasMany(Pengguna::class);
    }

    public function mataKuliah(): HasMany
    {
        return $this->hasMany(MataKuliah::class);
    }
}
