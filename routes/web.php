<?php

use App\Http\Controllers\{
    DashboardController,
    DataKelahiranController,
    DataKematianController,
    DataPendatangController,
    DataPindahController,
    DataSktmController,
    KartuKeluargaController,
    PendudukController,
    SettingController,
    UserController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'role:admin, petugas']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::group([
        'middleware' => 'role:admin'
    ], function () {
        Route::get('/kartu_keluarga/data', [KartuKeluargaController::class, 'data'])->name('kartu_keluarga.data');
        Route::resource('/kartu_keluarga', KartuKeluargaController::class)->except('create', 'edit');
        Route::get('/kartu_keluarga/detail/{id}', [KartuKeluargaController::class, 'detail'])->name('kartu_keluarga.detail');
        Route::get('/kartu_keluarga/{kartu_keluarga}/penduduk', [KartuKeluargaController::class, 'getPendudukData'])->name('kartu_keluarga.penduduk');

        Route::get('/penduduk/data', [PendudukController::class, 'data'])->name('penduduk.data');
        Route::get('/penduduk/detail/{id}', [PendudukController::class, 'detail'])->name('penduduk.detail');
        Route::resource('/penduduk', PendudukController::class)->except('create', 'edit');

        Route::get('/data_kelahiran/data', [DataKelahiranController::class, 'data'])->name('data_kelahiran.data');
        Route::resource('/data_kelahiran', DataKelahiranController::class)->except('create', 'edit');

        Route::get('/data_kelahiran/data', [DataKelahiranController::class, 'data'])->name('data_kelahiran.data');
        Route::resource('/data_kelahiran', DataKelahiranController::class)->except('create', 'edit');

        Route::get('/data_kematian/data', [DataKematianController::class, 'data'])->name('data_kematian.data');
        Route::resource('/data_kematian', DataKematianController::class)->except('create', 'edit');

        Route::get('/data_pendatang/data', [DataPendatangController::class, 'data'])->name('data_pendatang.data');
        Route::resource('/data_pendatang', DataPendatangController::class)->except('create', 'edit');

        Route::get('/data_pindah/data', [DataPindahController::class, 'data'])->name('data_pindah.data');
        Route::resource('/data_pindah', DataPindahController::class)->except('create', 'edit');

        Route::get('/data_sktm/data', [DataSktmController::class, 'data'])->name('data_sktm.data');
        Route::resource('/data_sktm', DataSktmController::class)->except('create', 'edit');

        Route::get('/pengguna/data', [UserController::class, 'data'])->name('pengguna.data');
        Route::resource('/pengguna', UserController::class)->except('create', 'edit');

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
    });

    Route::group([
        'middleware' => 'role:petugas'
    ], function () {
        //
    });
});
