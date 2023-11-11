<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'nama_aplikasi' => 'SIK-MASTER',
            'profil' => '-',
            'alamat' => '-',
            'kelurahan' => '-',
            'kecamatan' => '-',
            'kabupaten' => '-',
            'provinsi' => '-',
            'kode_pos' => '-',
        ]);
    }
}
