<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengujian extends Model
{
    use HasFactory;

    protected $table = 'pengujian';

    public function badgeColor()
    {
        $color = '';

        switch ($this->status) {
            case 'ditemukan':
                $color = 'success';
                break;
            case 'tidak ditemukan':
                $color = 'danger';
                break;
            default:
                # code...
                break;
        }

        return $color;
    }
}
