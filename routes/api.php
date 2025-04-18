<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\IjazahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KlarifikasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/user', UserController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/angkatan', AngkatanController::class);
Route::resource('/kelas', KelasController::class);
Route::resource('/klarifikasi', KlarifikasiController::class);
Route::resource('/absensi', AbsensiController::class);
Route::resource('/prestasi', PrestasiController::class);
Route::resource('/rapot', RaportController::class);
Route::resource('ijazah', IjazahController::class);
