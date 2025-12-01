<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Controller umum
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\StatusController;

// Controller admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\PendaftaranExportController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalMatakuliahController;
use App\Http\Controllers\Admin\LaporanController;
use maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================================
// Route Umum
// ============================================================================
Route::get('/', function () {
    return view('welcome');
});

// Menampilkan file dokumen pendaftaran untuk mahasiswa
Route::get('/dokumen-pendaftaran/{namafile}', function ($namafile) {
    $path = storage_path('app/private/dokumen/' . $namafile);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan.');
    }

    return response()->file($path);
})->middleware('auth')->name('dokumen.show');

// ============================================================================
// Dashboard utama
// ============================================================================
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================================================
// Grup route untuk Mahasiswa
// ============================================================================
Route::middleware('auth')->group(function () {
    // Profile pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Formulir pendaftaran
    Route::get('/formulir-pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/formulir-pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Status pendaftaran mahasiswa
    Route::get('/mahasiswa/status', [StatusController::class, 'index'])->name('mahasiswa.status');
});

// ============================================================================
// Grup route untuk ADMIN
// ============================================================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Program Studi
        Route::resource('program-studi', ProgramStudiController::class);

        // CRUD Pendaftaran
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [AdminPendaftaranController::class, 'index'])->name('index');
            Route::get('/export', [PendaftaranExportController::class, 'export'])->name('export');
            Route::get('/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('show');
            Route::get('/{pendaftaran}/edit', [AdminPendaftaranController::class, 'edit'])->name('edit');
            Route::put('/{pendaftaran}', [AdminPendaftaranController::class, 'update'])->name('update');
            Route::delete('/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('destroy');
            Route::post('/{pendaftaran}/verifikasi', [AdminPendaftaranController::class, 'verifikasi'])->name('verifikasi');
            Route::get('/dokumen/view/{id}', [AdminPendaftaranController::class, 'viewDokumen'])
                ->name('dokumen.view');

            Route::get('/dokumen/download/{id}', [AdminPendaftaranController::class, 'downloadDokumen'])
                ->name('dokumen.download');
        });


        // laporan pendaftaran
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
         Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
        // CRUD Mata Kuliah
        Route::resource('matakuliah', MatakuliahController::class);

        // CRUD Jadwal Mata Kuliah
        Route::resource('jadwal', JadwalMatakuliahController::class);
       
       
    });

// ============================================================================
// Auth
// ============================================================================
require __DIR__ . '/auth.php';
