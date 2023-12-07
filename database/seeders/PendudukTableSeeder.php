<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PendudukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 100) as $index) {
            $tanggal_lahir = $faker->dateTimeThisCentury('-18 years', '-45 years');
            $kartu_keluarga = $faker->numberBetween(1, 50);
            $formatTanggalLahir = $tanggal_lahir->format('Y-m-d');
            $usia = now()->diffInYears($tanggal_lahir);
            $jenis_kelamin = $faker->randomElement(['laki-laki', 'perempuan']);
            $nama = ($jenis_kelamin == 'laki-laki') ? $faker->firstNameMale() : $faker->firstNameFemale();
            $randomNumber = (string) $faker->randomNumber(4);
            $nik = "32" . $formatTanggalLahir . $randomNumber;
            $nik = str_replace('-', '', $nik);
            $agama = $faker->randomElement(['Islam', 'Kristen Katolik', 'Kristen Protestan', 'Hindu', 'Buddha', 'Khonghucu']);
            $pendidikan = $faker->randomElement(['TK', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'PascaSarjana']);
            $jenis_pekerjaan = ($pendidikan == 'TK' || $pendidikan == 'SD' || $pendidikan == 'SMP' || $pendidikan == 'SMA') ? 'Siswa' : $faker->jobTitle();
            $golonganDarah = $faker->randomElement(['A', 'B', 'AB', 'O', 'A+', 'B+', 'Tidak Tahu']);
            $statusPerkawinan = $faker->randomElement(['Belum Kawin', 'Kawin Tercatat', 'Kawin Tidak Tercatat', 'Cerai Hidup', 'Cerai Mati']);
            $tanggalPerkawinan = ($statusPerkawinan == 'Belum Kawin') ? null : $faker->date('Y-m-d');
            $statusKeluarga = $faker->randomElement(['Kepala Keluarga', 'Suami', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya']);
            $kewarganegaraan = $faker->randomElement(['WNI', 'WNA']);
            $noPaspor = ($kewarganegaraan == 'WNI') ? null : $faker->randomNumber(5);
            $noKitap = ($kewarganegaraan == 'WNI') ? null : $faker->randomNumber(5);
            $path_image = ($jenis_kelamin == 'laki-laki') ? 'penduduk/penduduk_20231107112014.png' : 'penduduk/penduduk_20231107112020.png';

            Penduduk::create([
                'nik' => $nik,
                'kartu_keluarga_id' => $kartu_keluarga,
                'nama_lengkap' => $nama,
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'usia' => $usia,
                'agama' => $agama,
                'pendidikan' => $pendidikan,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'golongan_darah' => $golonganDarah,
                'status_perkawinan' => $statusPerkawinan,
                'tanggal_perkawinan' => $tanggalPerkawinan,
                'status_keluarga' => $statusKeluarga,
                'kewarganegaraan' => $kewarganegaraan,
                'no_paspor' => $noPaspor,
                'no_kitap' => $noKitap,
                'nama_ayah' => $faker->firstNameMale(),
                'nama_ibu' => $faker->firstNameFemale(),
                'status' => 'valid',
                'path_image' => $path_image,
            ]);
        }
    }
}
