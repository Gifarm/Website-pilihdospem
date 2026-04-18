<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AdminUserController;

use App\Http\Controllers\DosenController;
use App\Http\Controllers\PengajuanController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MahasiswaController::class, 'form']);
Route::post('/submit', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/get-dosen/{id}', [MahasiswaController::class, 'getDosen']);


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index']);
    Route::resource('/admin/dosen', DosenController::class);
    Route::get('/admin/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::post('/admin/pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::post('/admin/dpengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
});
Route::get('/pengajuan/export', [PengajuanController::class, 'export'])
    ->middleware(['auth', 'role:admin'])
    ->name('pengajuan.export');


Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::get('/superadmin/home', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');

    // CRUD PRODI
    Route::resource('/superadmin/prodi', ProdiController::class);

    // CRUD ADMIN
    Route::resource('/superadmin/admin-user', AdminUserController::class);

    // RESET DATA
    Route::delete('/superadmin/reset-pengajuan', [SuperAdminController::class, 'reset']);
});

// Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
//     Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
// });
require __DIR__ . '/auth.php';
