<?php

namespace App\Exports;

use App\Models\KartuKeluarga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KartuKeluargaExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $kartu_keluarga = KartuKeluarga::withCount('penduduk')
            ->get()
            ->makeHidden(['created_at', 'updated_at'])
            ->toArray();

        $exportData = [];
        $i = 1;

        foreach ($kartu_keluarga as $item) {
            $exportData[] = [
                'No.' => $i++,
                'No. Kartu keluarga' => (string) $item['no_kk'],
                'Nama Kepala Keluarga' => $item['nama_kepala_keluarga'],
                'Alamat' => $item['alamat'],
                'RT' => $item['rt'],
                'RW' => $item['rw'],
                'Kode Pos' => $item['kode_pos'],
                'Desa/Kelurahan' => $item['kelurahan'],
                'Kecamatan' => $item['kecamatan'],
                'Kabupaten/Kota' => $item['kabupaten'],
                'Provinsi' => $item['provinsi'],
                'Tanggal Dikeluarkan' => tanggal_indonesia($item['tanggal_buat']),
                'Jumlah Anggota Keluarga' => (string) $item['penduduk_count'],
            ];
        }

        return $exportData;
    }

    public function headings(): array
    {
        return [
            'No.',
            'No. Kartu Keluarga',
            'Nama Kepala Keluarga',
            'Alamat',
            'RT',
            'RW',
            'Kode Pos',
            'Desa/Kelurahan',
            'Kecamatan',
            'Kabupaten/Kota',
            'Provinsi',
            'Tanggal Dikeluarkan',
            'Jumlah Anggota Keluarga',
        ];
    }
}
