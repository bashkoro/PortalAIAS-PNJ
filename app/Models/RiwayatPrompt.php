<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPrompt extends Model
{
    protected $table = 'riwayat_prompt';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function deklarasi(): BelongsTo
    {
        return $this->belongsTo(Deklarasi::class);
    }
}
