<?php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', [userController::class, 'show_home'])->name('user_home');
Route::get('/login', [userController::class, 'show_login'])->name('login');
Route::post('/loginakun', [loginController::class, 'loginakun']);
Route::get('/logout', [loginController::class, 'logout']);
Route::get('/pilih', [userController::class, 'show_pilih']);
Route::get('/input_guru', [userController::class, 'show_guru']);

Route::prefix('user')->group(function () {
    Route::post('/cari', [userController::class, 'cari']);
    Route::post('/kembalimemilih', [userController::class, 'kembalimemilih']);
    Route::put('/baca/{id}', [userController::class, 'tambah_membaca']);
    Route::put('/pinjam/{id}', [userController::class, 'tambah_meminjam']);
    Route::put('/kembali/{id}', [userController::class, 'tambah_mengembalikan']);
    Route::post('/pembelajaran', [userController::class, 'tambah_pembelajaran']);
    Route::post('/setbelajar', [userController::class, 'setbelajar']);
});

Route::group(['middleware' => 'admin'], function () {
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('admin_dashboard');
        Route::prefix('guru')->group(function () {
            Route::get('/', [AdminController::class, 'show_guru'])->name('admin_guru');
            Route::post('/tambah', [teacherController::class, 'tambah']);
            Route::put('/edit/{id}', [teacherController::class, 'edit']);
            Route::delete('/hapus/{id}', [teacherController::class, 'hapus']);
        });
        Route::prefix('siswa')->group(function () {
            Route::get('/', [AdminController::class, 'show_siswa'])->name('admin_siswa');
            Route::post('/tambah', [studentController::class, 'tambah']);
            Route::put('/edit/{id}', [studentController::class, 'edit']);
            Route::delete('/hapus/{id}', [studentController::class, 'hapus']);
        });
        Route::prefix('matkul')->group(function () {
            Route::get('/', [AdminController::class, 'show_matkul'])->name('admin_matkul');
            Route::post('/tambah', [SubjectController::class, 'tambah']);
            Route::put('/edit/{id}', [SubjectController::class, 'edit']);
            Route::delete('/hapus/{id}', [SubjectController::class, 'hapus']);
        });
        Route::prefix('absensi')->group(function () {
            Route::get('/', [AdminController::class, 'show_absensi'])->name('admin_absensi');
            Route::post('/tambah', [absensiController::class, 'tambah']);
            Route::put('/edit/{id}', [absensiController::class, 'edit']);
            Route::delete('/hapus/{id}', [absensiController::class, 'hapus']);
            Route::get('/excel1', [absensiController::class, 'exportExcelToday']);
            Route::get('/excel2', [absensiController::class, 'exportExcelThisMonth']);
            Route::get('/excel3', [absensiController::class, 'exportExcelThisYear']);
            Route::get('/pdf1', [absensiController::class, 'exportPdfToday']);
            Route::get('/pdf2', [absensiController::class, 'exportpdfThisMonth']);
            Route::get('/pdf3', [absensiController::class, 'exportPdfThisYear']);
        });
    });
});
