<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KartuKeluargaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i <= 50; $i++) {
            DB::table('kartu_keluarga')->insert([
                'no_kk' => $faker->randomNumber(8),
                'nama_kepala_keluarga' => $faker->firstNameMale(),
                'alamat' => $faker->address(),
                'rt' => $faker->randomElement(['1', '2', '3', '4', '5']),
                'rw' => '18',
                'kode_pos' => $faker->postcode(),
                'kelurahan' => 'Desa Setia Mekar',
                'kecamatan' => 'Tambun Selatan',
                'kabupaten' => 'Bekasi',
                'provinsi' => 'Jawa Barat',
                'tanggal_buat' => $faker->date('Y-m-d'),
            ]);
        }
    }
}
