<?php

use App\Http\Controllers\AbsenMandiriController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DaftarMandiriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KepAbsenController;
use App\Http\Controllers\KepDepartemenController;
use App\Http\Controllers\KepJabatanController;
use App\Http\Controllers\KepLaporanController;
use App\Http\Controllers\KepPegawaiController;
use App\Http\Controllers\KepRankingController;
use App\Http\Controllers\KepSettingController;
use App\Http\Controllers\KepSkorController;
use App\Http\Controllers\KepUserController;
use App\Http\Controllers\ListAbsenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [FrontendController::class, 'grafik'])->name('awal');

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/recovery', [LoginController::class, 'recovery'])->name('recovery');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::group(
    [
        'prefix'     => 'login'
    ],
    function () {
        Route::post('/proses', [LoginController::class, 'authenticate'])->name('login.proses');
    }
);

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        // kepegawaian
        Route::resource('/pengguna', UserController::class);
        Route::resource('/user_admin', KepUserController::class);
        Route::resource('/setting_data', KepSettingController::class);
        Route::resource('/departemen', KepDepartemenController::class);
        Route::resource('/jabatan_data', KepJabatanController::class);
        Route::resource('/skor_data', KepSkorController::class);
        Route::resource('/pegawai_data', KepPegawaiController::class);
        Route::get('/cetak_barcode', [KepPegawaiController::class, 'cetak_barcode'])->name('cetak_barcode');
        Route::resource('/absensi_pegawai', KepAbsenController::class);
        Route::post('/scanBarcode1', [KepAbsenController::class, 'scanBarcode1'])->name('absen.scanBarcode1');
        Route::post('/pilih_pegawai', [KepAbsenController::class, 'pilih_pegawai'])->name('absen.pilih_pegawai');
        
        Route::resource('/absensi_laporan', KepLaporanController::class);
        Route::get('/get_data_laporan', [KepLaporanController::class, 'get_data_laporan'])->name('get_data_laporan');
         Route::get('export_data', [KepLaporanController::class, 'export_data'])->name('export_data');

         //kepegawaian ranking
        // Route::resource('/ranking', KepRankingController::class);
        Route::prefix('kepegawaian')->group(function() {
            Route::resource('ranking', KepRankingController::class)->names([
                'index' => 'ranking.index',
                'create' => 'ranking.create',
                'store' => 'ranking.store',
                'show' => 'ranking.show',
                'edit' => 'ranking.edit',
                'update' => 'ranking.update',
                'destroy' => 'ranking.destroy'
            ]);
        });
        
    }
);
