<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga';

    public function detail_kartu_keluarga()
    {
        return $this->belongsToMany(Penduduk::class, 'detail_kartu_keluarga');
    }
}
