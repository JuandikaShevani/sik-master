<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function array(): array
    {
        $penduduk = Penduduk::with('kartu_keluarga')
            ->orderBy('kartu_keluarga_id', 'asc')
            ->get()
            ->makeHidden(['created_at', 'updated_at', 'status', 'path_image'])
            ->toarray();

        $exportData = [];
        $i = 1;

        foreach ($penduduk as $item) {
            $tanggalPerkawinan = $item['tanggal_perkawinan'] ? tanggal_indonesia($item['tanggal_perkawinan']) : '-';
            $noPaspor = $item['no_paspor'] ?? '-';
            $noKitap = $item['no_kitap'] ?? '-';
            $noHp = $item['no_hp'] ?? '-';

            $exportData[] = [
                'No.' => $i++,
                'NIK' => (string) $item['nik'],
                'No. Kartu Keluarga' => $item['kartu_keluarga']['no_kk'] . ' - ' . $item['kartu_keluarga']['nama_kepala_keluarga'],
                'Nama Lengkap' => $item['nama_lengkap'],
                'Jenis Kelamin' => $item['jenis_kelamin'],
                'Tempat Lahir' => $item['tempat_lahir'],
                'Tanggal Lahir' => tanggal_indonesia($item['tanggal_lahir']),
                'Usia' => $item['usia'],
                'Agama' => $item['agama'],
                'Pendidikan' => $item['pendidikan'],
                'Jenis Pekerjaan' => $item['jenis_pekerjaan'],
                'Tanggal Perkawinan' => $tanggalPerkawinan,
                'Status Keluarga' => $item['status_keluarga'],
                'Kewarganegaraan' => $item['kewarganegaraan'],
                'No. Paspor' => $noPaspor,
                'No. Kitap' => $noKitap,
                'Nama Ayah' => $item['nama_ayah'],
                'Nama Ibu' => $item['nama_ibu'],
                'No. Hp' => $noHp,
            ];
        }
        return $exportData;
    }

    public function headings(): array
    {
        return [
            'No.',
            'NIK',
            'No. Kartu Keluarga',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Usia',
            'Agama',
            'Pendidikan',
            'Jenis Pekerjaan',
            'Tanggal Perkawinan',
            'Status Keluarga',
            'Kewarganegaraan',
            'No. Paspor',
            'No. Kitap',
            'Nama Ayah',
            'Nama Ibu',
            'No. Hp'
        ];
    }
}
