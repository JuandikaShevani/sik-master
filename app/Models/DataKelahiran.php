<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelahiran_penduduk';

    public function kartu_keluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kartu_keluarga_id', 'id');
    }
}
