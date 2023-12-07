<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $table = 'kartu_keluarga';

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'kartu_keluarga_id', 'id');
    }
}
