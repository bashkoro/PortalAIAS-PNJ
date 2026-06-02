<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HakAkses extends Model
{
    protected $table = 'hak_akses';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function pengguna(): HasMany
    {
        return $this->hasMany(Pengguna::class);
    }
}
