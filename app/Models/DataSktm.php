<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSktm extends Model
{
    use HasFactory;

    protected $table = 'sktm_penduduk';

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id', 'id');
    }
}
