<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\PerlengkapanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth')->group(function () {
    Route::put('/data/{id}/updatePulang', [AbsensiController::class, 'updatePulang'])->name('data.update');
    Route::post('/data/{id}/updateAbsenPulang', [AbsensiController::class, 'updateAbsenPulang'])->name('data-telat.update');
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/absensi', AbsensiController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin/data-absen', [AdminController::class, 'absen'])->name('admin.absen');
    Route::get('/admin/data-izin', [AdminController::class, 'izin'])->name('admin.izin');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/export-izin', [AdminController::class, 'exp'])->name('admin.export-izin');
    Route::resource('/admin', AdminController::class);
    Route::resource('/client/data-client', ClientController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/kerjasamas', KerjasamaController::class);
    Route::resource('/devisi', DivisiController::class);
    Route::resource('/perlengkapan', PerlengkapanController::class);
    Route::get('/divisi/{divisiId}/add-equipment', [DivisiController::class, 'editEquipment'])->name('editRquipment');
    Route::post('/divisi/{divisiId}/add-equipment', [DivisiController::class,'addEquipment'])->name('addEquipment');

});


require __DIR__.'/auth.php';
