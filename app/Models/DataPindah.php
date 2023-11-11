<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPindah extends Model
{
    use HasFactory;

    protected $table = 'pindah_penduduk';

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
