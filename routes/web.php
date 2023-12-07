<?php

use App\Http\Controllers\{
    DashboardController,
    DataKelahiranController,
    DataKematianController,
    DataPendatangController,
    DataPindahController,
    DataSktmController,
    FrontController,
    KartuKeluargaController,
    LaporanController,
    PendudukController,
    PengujianController,
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('landing_page');

Route::group([
    'middleware' => ['auth', 'role:admin,petugas']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Route::get('/get-districts', [KartuKeluargaController::class, 'getDistricts'])->name('get.districts');
    // Route::get('/get-regencies', [KartuKeluargaController::class, 'getRegencies'])->name('get.regencies');
    // Route::get('/get-provinces', [KartuKeluargaController::class, 'getProvinces'])->name('get.provinces');
    // Route::get('/get-regency-province', [KartuKeluargaController::class, 'getRegencyProvince'])->name('get.regency-province');
    // Route::get('/get-province', [KartuKeluargaController::class, 'getProvince'])->name('get.province');

    Route::get('/kartu_keluarga/data', [KartuKeluargaController::class, 'data'])->name('kartu_keluarga.data');
    Route::delete('/kartu_keluarga/delete-multiple', [KartuKeluargaController::class, 'deleteMultiple'])->name('kartu_keluarga.delete-multiple');
    Route::resource('/kartu_keluarga', KartuKeluargaController::class)->except('create', 'edit');
    Route::get('/kartu_keluarga/detail/{id}', [KartuKeluargaController::class, 'detail'])->name('kartu_keluarga.detail');
    Route::get('/kartu_keluarga/{kartu_keluarga}/penduduk', [KartuKeluargaController::class, 'getPendudukData'])->name('kartu_keluarga.penduduk');

    Route::get('/penduduk/data', [PendudukController::class, 'data'])->name('penduduk.data');
    Route::delete('/penduduk/delete-multiple', [PendudukController::class, 'deleteMultiple'])->name('penduduk.delete-multiple');
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

    Route::get('/laporan/kartu_keluarga', [LaporanController::class, 'indexKK'])->name('laporan.kartu_keluarga');
    Route::get('/laporan/kartu_keluarga/data/{start}/{end}', [LaporanController::class, 'dataKK'])->name('laporan.data_kartu_keluarga');
    Route::get('/laporan/kartu_keluarga/pdf/{start}/{end}', [LaporanController::class, 'cetakPDFKK'])->name('laporan.kartu_keluarga_pdf');
    Route::get('/laporan/kartu_keluarga/pdf/{id}', [LaporanController::class, 'cetakDetailPDFKK'])->name('laporan.kartu_keluarga_pdf_detail');
    Route::get('/laporan/kartu_keluarga/excel', [LaporanController::class, 'exportExcelKK'])->name('laporan.kartu_keluarga_excel');

    Route::get('/laporan/penduduk', [LaporanController::class, 'index'])->name('laporan.penduduk');
    Route::get('/laporan/penduduk/data/{start}/{end}', [LaporanController::class, 'data'])->name('laporan.data_penduduk');
    Route::get('/laporan/penduduk/pdf/{start}/{end}', [LaporanController::class, 'cetakPDF'])->name('laporan.penduduk_pdf');
    Route::get('/laporan/penduduk/excel', [LaporanController::class, 'exportExcel'])->name('laporan.penduduk_excel');

    Route::group([
        'middleware' => 'role:admin'
    ], function () {
        Route::get('/pengguna/data', [UserController::class, 'data'])->name('pengguna.data');
        Route::resource('/pengguna', UserController::class)->except('create', 'edit');

        Route::get('/pengujian/data', [PengujianController::class, 'data'])->name('pengujian.data');
        Route::get('/pengujian/hasil-data', [PengujianController::class, 'hasilData'])->name('pengujian.hasil-data');
        Route::get('/pengujian/get-data', [PengujianController::class, 'getData'])->name('pengujian.get-data');
        Route::resource('/pengujian', PengujianController::class);
        Route::post('/pengujian/reset', [PengujianController::class, 'reset'])->name('pengujian.reset');

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
    });

    Route::group([
        'middleware' => 'role:petugas'
    ], function () {
        //
    });
});
