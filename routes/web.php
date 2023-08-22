<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JadwalUserController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LEADER_Controller\MainController as LeaderController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PerlengkapanController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SVP_Controller\MainController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\AreaController;
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
    return view('auth.login');
});

Route::view('/map', 'absensi.maps');


Route::middleware('auth', 'apdt')->group(function () {
    Route::put('/data/{id}/updatePulang', [AbsensiController::class, 'updatePulang'])->name('data.update');
    Route::post('/data/{id}/updateAbsenPulang', [AbsensiController::class, 'updateAbsenPulang'])->name('data-telat.update');
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/absensi', AbsensiController::class);
    Route::get('/historyAbsensi', [AbsensiController::class, 'historyAbsensi']);
    Route::resource('/profile', ProfileController::class);
    Route::resource('/lembur', LemburController::class)->only('index', 'store', 'update');
    Route::get('/lembur-history', [LemburController::class, 'lemburIndexUser'])->name('lemburIndexUser');
    Route::get('/rate/{id}', [RatingController::class, 'myRate']);
    Route::resource('/laporan', LaporanController::class)->only('index', 'create', 'store');
    Route::get('/mypoint/{id}', [PointController::class, 'myPoint'])->name('mypoint');
});

Route::middleware('auth', 'spv', 'apdt')->group(function () {
    Route::get('/SPV/spv-absensi', [MainController::class, 'indexAbsen'])->name('spv_absensi');
    Route::get('/SPV/spv-laporan', [MainController::class, 'indexLaporan'])->name('spv_laporan');
    Route::get('/SPV/spv-lembur', [MainController::class, 'indexLembur'])->name('spv_lembur');
    Route::get('/SPV/spv-user', [MainController::class, 'indexUser'])->name('spv_user');
});

Route::middleware('auth', 'leader', 'apdt')->group(function () {
    Route::get('/LEADER/leader-absensi', [LeaderController::class, 'indexAbsen'])->name('lead_absensi');
    Route::get('/LEADER/leader-laporan', [LeaderController::class, 'indexLaporan'])->name('lead_laporan');
    Route::get('/LEADER/leader-lembur', [LeaderController::class, 'indexLembur'])->name('lead_lembur');
    Route::get('/LEADER/leader-user', [LeaderController::class, 'indexUser'])->name('lead_user');
    Route::resource('/LEADER/leader-jadwal', JadwalUserController::class);
    Route::get('/LEADER/leader-jadwal-new', [JadwalUserController::class, 'processDate'])->name('store.processDare');
});

Route::middleware('auth', 'admin', 'apdt')->group(function () {
    Route::get('/admin/data-absen', [AdminController::class, 'absen'])->name('admin.absen');
    Route::get('/admin/data-izin', [AdminController::class, 'izin'])->name('admin.izin');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/exportV2', [AdminController::class, 'exportWith'])->name('admin.exportV2');
    Route::get('/admin/export-izin', [AdminController::class, 'exp'])->name('admin.export-izin');
    Route::resource('/admin', AdminController::class);
    Route::resource('/client/data-client', ClientController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/kerjasamas', KerjasamaController::class);
    Route::resource('/devisi', DivisiController::class);
    Route::resource('/perlengkapan', PerlengkapanController::class);
    Route::get('/divisi/{divisiId}/add-equipment', [DivisiController::class, 'editEquipment'])->name('editRquipment');
    Route::post('/divisi/{divisiId}/add-equipment', [DivisiController::class,'addEquipment'])->name('addEquipment');
    Route::resource('/data-lembur', LemburController::class);
    Route::get('/data-lembur-saat-ini', [LemburController::class, 'lemburIndexAdmin'])->name('lemburList');
    Route::resource('/rating', RatingController::class);
    Route::resource('/shift', ShiftController::class);
    Route::resource('/jabatan', JabatanController::class);
    Route::delete('/laporans/{id}', [LaporanController::class, 'destroy']);
    Route::get('/export/laporans', [LaporanController::class, 'export'])->name('export.laporans');
    Route::resource('/ruangan', RuanganController::class);
    Route::resource('/point', PointController::class);
    Route::patch('/claim-point/{id}', [AbsensiController::class, 'claimPoint'])->name('claim.point');
    Route::resource('holiday', HolidayController::class);
    Route::resource('/lokasi', LokasiController::class);
    Route::resource('/area', AreaController::class);
});


require __DIR__.'/auth.php';
