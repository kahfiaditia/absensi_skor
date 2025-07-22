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
        
      
        // menu
        Route::resource('/pengguna', UserController::class);
        Route::get('/halaman', [UserController::class, 'halaman'])->name('pengguna.halaman');
        Route::get('/halaman_guru', [UserController::class, 'halaman_guru'])->name('pengguna.halaman_guru');
        Route::get('/profil', [UserController::class, 'profil'])->name('pengguna.profil');
        Route::patch('/updateprofil/{id}', [UserController::class, 'updateprofil'])->name('pengguna.updateprofil');
        Route::get('/alluser', [UserController::class, 'alluser'])->name('pengguna.alluser');
        Route::get('/data_guru', [UserController::class, 'data_guru'])->name('pengguna.data_guru');
        Route::get('/admin', [UserController::class, 'admin'])->name('pengguna.admin');
        Route::post('/upload_excel', [UserController::class, 'uploadExcel'])->name('pengguna.uploadExcel');
        Route::get('/hasil_import', [UserController::class, 'hasil_import'])->name('pengguna.hasil_import');
        Route::get('/gagal_import', [UserController::class, 'gagal_import'])->name('pengguna.gagal_import');
        Route::get('/hapus_semua', [UserController::class, 'hapus_semua'])->name('pengguna.hapus_semua');
        Route::get('/hapus_semua_guru', [UserController::class, 'hapus_semua_guru'])->name('pengguna.hapus_semua_guru');
        Route::post('/simpan_user_ajax', [UserController::class, 'simpanUserAjax'])->name('pengguna.simpanUserAjax');
        Route::get('/get_data_siswa', [UserController::class, 'get_data_siswa'])->name('pengguna.get_data_siswa');
        Route::get('/get_data_guru', [UserController::class, 'get_data_guru'])->name('pengguna.get_data_guru');
        Route::get('/guru/{id}/edit', [UserController::class, 'edit_guru'])->name('pengguna.edit_guru');
        Route::get('/get_data_administrator', [UserController::class, 'get_data_administrator'])->name('pengguna.get_data_administrator');
        Route::get('/cari_data_all', [UserController::class, 'cari_data_all'])->name('pengguna.cari_data_all');
        Route::get('/tambah_siswa', [UserController::class, 'tambah_siswa'])->name('pengguna.tambah_siswa');
        Route::get('/tambah_administrator', [UserController::class, 'tambah_administrator'])->name('pengguna.tambah_administrator');
        Route::get('/siswa/{id}/edit', [UserController::class, 'edit_siswa'])->name('pengguna.edit_siswa');
        Route::get('/admin/{id}/edit', [UserController::class, 'edit_admin'])->name('pengguna.edit_admin');
        Route::patch('/update_edit_siswa', [UserController::class, 'update_edit_siswa'])->name('pengguna.update_edit_siswa');
        Route::post('/reset_password/{id}', [UserController::class, 'reset_password'])->name('pengguna.reset_password');

        //list_user_all//
        Route::get('/get_list_user_siswa', [UserController::class, 'get_list_user_siswa'])->name('pengguna.get_list_user_siswa');
        Route::get('/get_list_user_guru', [UserController::class, 'get_list_user_guru'])->name('pengguna.get_list_user_guru');
        Route::get('/get_list_user_administrator', [UserController::class, 'get_list_user_administrator'])->name('pengguna.get_list_user_administrator');
        Route::get('/data-guru', [UserController::class, 'listDataGuru'])->name('list_data_guru');
        Route::get('/data-administrator', [UserController::class, 'listDataAdministrator'])->name('list_data_administrator');
        Route::get('/siswa-list_user/{id}/edit', [UserController::class, 'edit_siswa_list_user'])->name('pengguna.edit_siswa_list_user');
        Route::patch('/pengguna/update-siswa-listuser/{id}', [UserController::class, 'updateSiswa'])->name('pengguna.update_siswa_listuser');
        Route::get('/tambah_siswa_listuser', [UserController::class, 'tambah_siswa_listuser'])->name('pengguna.tambah_siswa_listuser');
        Route::post('/pengguna/storelistuser', [UserController::class, 'storeListUser'])->name('pengguna.storelistuser');
        Route::get('/guru-list_user/{id}/edit', [UserController::class, 'edit_guru_list_user'])->name('pengguna.edit_guru_list_user');
        Route::patch('/pengguna/update-guru-listuser/{id}', [UserController::class, 'updateGuru'])->name('pengguna.update_guru_listuser');
        Route::get('/tambah_guru_listuser', [UserController::class, 'tambah_guru_listuser'])->name('pengguna.tambah_guru_listuser');
        Route::post('/pengguna/storelistguru', [UserController::class, 'storelistguru'])->name('pengguna.storelistguru');

        Route::get('/admin-list_user/{id}/edit', [UserController::class, 'edit_admin_list_user'])->name('pengguna.edit_admin_list_user');
        Route::patch('/pengguna/update-admin-listuser/{id}', [UserController::class, 'updateAdmin'])->name('pengguna.update_admin_listuser');
        Route::get('/tambah_admin_listuser', [UserController::class, 'tambah_admin_listuser'])->name('pengguna.tambah_admin_listuser');
        Route::post('/pengguna/storelistadmin', [UserController::class, 'storelistadmin'])->name('pengguna.storelistadmin');
        //list_user_all//

        
        
       
        Route::get('/download-guru', [UserController::class, 'template_guru'])->name('template_guru');

      
        Route::resource('/daftar_mandiri', DaftarMandiriController::class);
        Route::get('/daftar-mandiri/{dataId}', [DaftarMandiriController::class, 'daftar_kegiatan'])->name('daftar_mandiri.daftar_kegiatan');
        Route::resource('/daftar_absensi', AbsensiController::class);
        Route::post('/simpan-absensi',  [AbsensiController::class, 'simpan'])->name('daftar_absensi.simpan');
        Route::resource('/data_list_absen', ListAbsenController::class);
        Route::get('/absen_edit', [ListAbsenController::class, 'absen_edit'])->name('data_list_absen.absen_edit');
        Route::get('/data_list_absen/edit_absen_hasil/{id}',  [ListAbsenController::class, 'edit_absen_hasil'])->name('data_list_absen.edit_absen_hasil');

        Route::post('/data_jadwal', [ListAbsenController::class, 'data_jadwal'])->name('data_list_absen.data_jadwal');
        Route::post('/data_tanggal', [ListAbsenController::class, 'getDataTanggal'])->name('data_list_absen.data_tanggal');
        Route::post('/data_absen', [ListAbsenController::class, 'data_absen'])->name('data_list_absen.data_absen');
        Route::resource('/absen_mandiri', AbsenMandiriController::class);
        Route::post('/data_hadir', [AbsenMandiriController::class, 'data_hadir'])->name('absen_mandiri.data_hadir');
    }
);
