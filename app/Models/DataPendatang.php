<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPendatang extends Model
{
    use HasFactory;

    protected $table = 'datang_penduduk';

    public function pelapor()
    {
        return $this->belongsTo(Penduduk::class, 'pelapor_id', 'id');
    }
}
