<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\PendaftaranExportController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalMatakuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===============================
// Route Umum
// ===============================

// Landing page
Route::get('/', function () {
    return view('welcome');
});

// Menampilkan file dokumen pendaftaran secara aman
Route::get('/dokumen-pendaftaran/{namafile}', function ($namafile) {
    $path = 'public/dokumen/' . $namafile;

    if (!Storage::exists($path)) {
        abort(404);
    }

    return Storage::response($path);
})->name('dokumen.show');

// ===============================
// Dashboard utama
// ===============================
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===============================
// Grup route setelah login (Mahasiswa & Admin)
// ===============================
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Formulir Pendaftaran (Mahasiswa)
    Route::get('/formulir-pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/formulir-pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Status Pendaftaran (Mahasiswa)
    Route::get('/mahasiswa/status', [StatusController::class, 'index'])->name('mahasiswa.status');
});

// ===============================
// Grup route ADMIN
// ===============================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Program Studi
        Route::resource('program-studi', ProgramStudiController::class);

        // CRUD Pendaftaran Admin
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [AdminPendaftaranController::class, 'index'])->name('index');
            Route::get('/laporan', [AdminPendaftaranController::class, 'laporan'])->name('laporan');
            Route::get('/export', [PendaftaranExportController::class, 'export'])->name('export');
            Route::get('/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('show');
            Route::get('/{pendaftaran}/edit', [AdminPendaftaranController::class, 'edit'])->name('edit');
            Route::put('/{pendaftaran}', [AdminPendaftaranController::class, 'update'])->name('update');
            Route::delete('/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('destroy');
            Route::post('/{pendaftaran}/verifikasi', [AdminPendaftaranController::class, 'verifikasi'])->name('verifikasi');

            // Dokumen pendaftaran
            Route::get('/dokumen/view/{id}', [AdminPendaftaranController::class, 'viewDokumen'])->name('dokumen.view');
            Route::get('/dokumen/download/{id}', [AdminPendaftaranController::class, 'downloadDokumen'])->name('dokumen.download');
        });

        // CRUD Mata Kuliah
        Route::resource('matakuliah', MatakuliahController::class);

        // CRUD Jadwal Mata Kuliah
        Route::resource('jadwal', JadwalMatakuliahController::class);
    });

// ===============================
// Auth (Login, Register, dll.)
// ===============================
require __DIR__ . '/auth.php';
