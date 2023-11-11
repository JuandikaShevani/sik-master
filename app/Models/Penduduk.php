<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';

    public function detail_kartu_keluarga()
    {
        return $this->belongsToMany(KartuKeluarga::class, 'detail_kartu_keluarga');
    }
}
