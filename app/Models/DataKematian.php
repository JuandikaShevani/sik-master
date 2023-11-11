<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKematian extends Model
{
    use HasFactory;

    protected $table = 'kematian_penduduk';

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
