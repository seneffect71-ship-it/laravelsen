<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KrsController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/krs', [KrsController::class,'index'])->name('krs.index');
Route::get('/krs-create', [KrsController::class,'create'])->name('krs.create');
Route::post('/krs', [KrsController::class,'store'])->name('krs.store');
Route::delete('/krs/{id}', [KrsController::class,'destroy'])->name('krs.delete');


Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::get('/mahasiswa-create', [MahasiswaController::class, 'create'])->name('mahasiswa.add');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.save');
Route::get('/mahasiswa-edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');


Route::get('/dosen', [DosenController::class, 'index']);
Route::get('/dosen/{id}', [DosenController::class, 'show']);
Route::get('/dosen-create', [DosenController::class, 'create'])->name('dosen.add');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.save');
Route::get('/dosen-edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.delete');


Route::get('/matakuliah', [MataKuliahController::class, 'index']);
Route::get('/matakuliah/{id}', [MataKuliahController::class, 'show']);
Route::get('/matakuliah-create', [MataKuliahController::class, 'create'])->name('matakuliah.add');
Route::post('/matakuliah', [MataKuliahController::class, 'store'])->name('matakuliah.save');
Route::get('/matakuliah-edit/{id}', [MataKuliahController::class, 'edit'])->name('matakuliah.edit');
Route::put('/matakuliah/{id}', [MataKuliahController::class, 'update'])->name('matakuliah.update');
Route::delete('/matakuliah/{id}', [MataKuliahController::class, 'destroy'])->name('matakuliah.delete');


Route::get('/jurusan', [JurusanController::class, 'index']);
Route::get('/jurusan/{id}', [JurusanController::class, 'show']);
Route::get('/jurusan-create', [JurusanController::class, 'create'])->name('jurusan.add');
Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.save');
Route::get('/jurusan-edit/{id}', [JurusanController::class, 'edit'])->name('jurusan.edit');
Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.delete');


Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/kelas-create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.delete');


