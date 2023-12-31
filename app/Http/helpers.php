<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

// if (!function_exists('upload')) {
//     function upload($directory, $file, $filename = "")
//     {
//         $extension = $file->getClientOriginalExtension();
//         $filename = "{$filename}_" . date('Ymdhis') . ".{$extension}";

//         Storage::disk('public')->putFileAs("/$directory", $file, $filename);

//         return "/$directory/$filename";
//     }
// }

if (!function_exists('upload')) {
    function upload($directory, $file, $filename = "", $width = null, $height = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = "{$filename}_" . date('Ymdhis') . ".{$extension}";

        $image = Image::make($file);

        if ($width !== null && $height !== null) {
            $image->fit($width, $height);
        }

        Storage::disk('public')->put("/$directory/$filename", $image->encode());

        return "/$directory/$filename";
    }
}


if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tgl, $tampil_hari = false)
    {
        $nama_hari  = array(
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
        );
        $nama_bulan = array(
            1 =>
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        $tahun   = substr($tgl, 0, 4);
        $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
        $tanggal = substr($tgl, 8, 2);
        $text    = '';

        if ($tampil_hari) {
            $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
            $hari        = $nama_hari[$urutan_hari];
            $text       .= "$hari, $tanggal $bulan $tahun";
        } else {
            $text       .= "$tanggal $bulan $tahun";
        }

        return $text;
    }
}
