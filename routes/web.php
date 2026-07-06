<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\KrsDetailController;
use App\Http\Controllers\AuthController;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public and Auth routes
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function (Request $request) {
        $user = session('user');

        switch ($user['role']) {
            case 'admin':
                return view('dashboard', [
                    'stats' => [
                        'dosen' => Dosen::count(),
                        'mahasiswa' => Mahasiswa::count(),
                        'matakuliah' => MataKuliah::count(),
                        'jurusan' => Jurusan::count(),
                        'krs' => Krs::count(),
                        'kelas' => Kelas::count(),
                    ],
                    'recentKrs' => Krs::with('mahasiswa')->latest()->take(5)->get(),
                ]);

            case 'dosen':
                // Dosen tetap punya akses approval KRS, tapi dashboard-nya juga tampil
                return view('dashboard', [
                    'stats' => [
                        'dosen' => Dosen::count(),
                        'mahasiswa' => Mahasiswa::count(),
                        'matakuliah' => MataKuliah::count(),
                        'jurusan' => Jurusan::count(),
                        'krs' => Krs::count(),
                        'kelas' => Kelas::count(),
                    ],
                    // Tampilkan ringkasan KRS terbaru (bisa juga dipersempit lagi jika mau)
                    'recentKrs' => Krs::with('mahasiswa')->latest()->take(5)->get(),
                ]);

            case 'mahasiswa':
                $krsMahasiswa = Krs::where('mahasiswa_id', $user['id']);
                // dashboard.blade.php butuh stats yang konsisten (dosen/mahasiswa/matakuliah/jurusan/krs/kelas)
                return view('dashboard', [
                    'stats' => [
                        'dosen' => Dosen::count(),
                        'mahasiswa' => Mahasiswa::count(),
                        'matakuliah' => MataKuliah::count(),
                        'jurusan' => Jurusan::count(),
                        'krs' => (clone $krsMahasiswa)->count(),
                        'kelas' => Kelas::count(),
                    ],
                    'recentKrs' => Krs::with('mahasiswa')
                        ->where('mahasiswa_id', $user['id'])
                        ->latest()
                        ->take(5)
                        ->get(),
                ]);


            default:
                // Fallback for any other roles or if role is not set
                return redirect('/login');
        }
    })->name('dashboard');

    // Routes for Admin, Dosen, and Mahasiswa (Read-only for Dosen & Mahasiswa)
    Route::middleware(['role:admin,dosen,mahasiswa'])->group(function () {
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');

        Route::get('/matakuliah', [MataKuliahController::class, 'index'])->name('matakuliah.index');
        Route::get('/matakuliah/{id}', [MataKuliahController::class, 'show'])->name('matakuliah.show');
        
        Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
        Route::get('/jurusan/{id}', [JurusanController::class, 'show'])->name('jurusan.show');
        
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index'); // Mahasiswa can see class list
    });

    // Routes for Admin Only (CRUD Operations)
    Route::middleware(['role:admin'])->group(function () {
        // Mahasiswa
        Route::get('/mahasiswa-create', [MahasiswaController::class, 'create'])->name('mahasiswa.add');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.save');
        Route::get('/mahasiswa-edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');

        // Dosen
        Route::get('/dosen-create', [DosenController::class, 'create'])->name('dosen.add');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.save');
        Route::get('/dosen-edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.delete');

        // Mata Kuliah
        Route::get('/matakuliah-create', [MataKuliahController::class, 'create'])->name('matakuliah.add');
        Route::post('/matakuliah', [MataKuliahController::class, 'store'])->name('matakuliah.save');
        Route::get('/matakuliah-edit/{id}', [MataKuliahController::class, 'edit'])->name('matakuliah.edit');
        Route::put('/matakuliah/{id}', [MataKuliahController::class, 'update'])->name('matakuliah.update');
        Route::delete('/matakuliah/{id}', [MataKuliahController::class, 'destroy'])->name('matakuliah.delete');
        
        // Jurusan
        Route::get('/jurusan-create', [JurusanController::class, 'create'])->name('jurusan.add');
        Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.save');
        Route::get('/jurusan-edit/{id}', [JurusanController::class, 'edit'])->name('jurusan.edit');
        Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.delete');

        // Kelas
        Route::get('/kelas-create', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.delete');

        // User Management
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Routes for Dosen Only (KRS Approval)
    Route::middleware(['role:dosen,admin'])->group(function () {
        Route::get('/krs-approval', [KrsController::class, 'indexForDosen'])->name('krs.index.dosen'); 
        Route::post('/krs/{id}/status', [KrsController::class, 'updateStatus'])->name('krs.status');
        Route::post('/krs-detail/{id}/status', [KrsDetailController::class, 'updateStatus'])->name('krs_detail.status');
    });

    // Routes for Mahasiswa and Admin (KRS Management)
    Route::middleware(['role:mahasiswa,admin'])->group(function () {
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/create', [KrsController::class, 'create'])->name('krs.create');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::get('/krs/{id}', [KrsController::class, 'show'])->name('krs.show');
    });
});
