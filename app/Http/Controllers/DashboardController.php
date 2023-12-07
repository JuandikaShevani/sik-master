<?php

namespace App\Http\Controllers;

use App\Models\DataKelahiran;
use App\Models\DataKematian;
use App\Models\DataPendatang;
use App\Models\DataPindah;
use App\Models\DataSktm;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {

            $jumlahKK = KartuKeluarga::count();
            $jumlahPenduduk = Penduduk::count();
            $jumlahKelahiran = DataKelahiran::count();
            $jumlahKematian = DataKematian::count();
            $jumlahPendatang = DataPendatang::count();
            $jumlahPindah = DataPindah::count();
            $jumlahUser = User::count();
            $jumlahKemiskinan = DataSktm::count();

            $jumlahBalita = Penduduk::whereBetween('usia', [0, 5])->count();
            $jumlahKanak = Penduduk::whereBetween('usia', [6, 12])->count();
            $jumlahRemaja = Penduduk::whereBetween('usia', [13, 24])->count();
            $jumlahDewasa = Penduduk::whereBetween('usia', [25, 44])->count();
            $jumlahLansia = Penduduk::where('usia', '>', 45)->count();

            $listNama = ['Balita', 'Kanak-kanak',  'Remaja', 'Dewasa', 'Lansia'];
            $listJumlahPria = [
                Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [0, 5])->count(),
                Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [6, 12])->count(),
                Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [13, 24])->count(),
                Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [25, 44])->count(),
                Penduduk::where('jenis_kelamin', 'laki-laki')->where('usia', '>', 45)->count(),
            ];

            $listJumlahPerempuan = [
                Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [0, 5])->count(),
                Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [6, 12])->count(),
                Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [13, 24])->count(),
                Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [25, 44])->count(),
                Penduduk::where('jenis_kelamin', 'perempuan')->where('usia', '>', 45)->count(),
            ];

            return view('dashboard', compact(
                'jumlahKK',
                'jumlahPenduduk',
                'jumlahKelahiran',
                'jumlahKematian',
                'jumlahPendatang',
                'jumlahPindah',
                'jumlahUser',
                'jumlahKemiskinan',
                'jumlahBalita',
                'jumlahKanak',
                'jumlahRemaja',
                'jumlahDewasa',
                'jumlahLansia',
                'listNama',
                'listJumlahPria',
                'listJumlahPerempuan'
            ));
        }

        $jumlahBalita = Penduduk::whereBetween('usia', [0, 5])->count();
        $jumlahKanak = Penduduk::whereBetween('usia', [6, 12])->count();
        $jumlahRemaja = Penduduk::whereBetween('usia', [13, 24])->count();
        $jumlahDewasa = Penduduk::whereBetween('usia', [25, 44])->count();
        $jumlahLansia = Penduduk::where('usia', '>', 45)->count();


        $listNama = ['Balita', 'Kanak-kanak',  'Remaja', 'Dewasa', 'Lansia'];
        $listJumlahPria = [
            Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [0, 5])->count(),
            Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [6, 12])->count(),
            Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [13, 24])->count(),
            Penduduk::where('jenis_kelamin', 'laki-laki')->whereBetween('usia', [25, 44])->count(),
            Penduduk::where('jenis_kelamin', 'laki-laki')->where('usia', '>', 45)->count(),
        ];

        $listJumlahPerempuan = [
            Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [0, 5])->count(),
            Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [6, 12])->count(),
            Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [13, 24])->count(),
            Penduduk::where('jenis_kelamin', 'perempuan')->whereBetween('usia', [25, 44])->count(),
            Penduduk::where('jenis_kelamin', 'perempuan')->where('usia', '>', 45)->count(),
        ];

        return view('dashboard2', compact(
            'jumlahBalita',
            'jumlahKanak',
            'jumlahRemaja',
            'jumlahDewasa',
            'jumlahLansia',
            'listNama',
            'listJumlahPria',
            'listJumlahPerempuan',
        ));
    }
}
