<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalMatakuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk menampilkan file dokumen secara aman
Route::get('/dokumen-pendaftaran/{namafile}', function ($namafile) {
    $path = 'public/dokumen/' . $namafile;

    if (!Storage::exists($path)) {
        abort(404);
    }

    return Storage::response($path);
})->name('dokumen.show');

// Route untuk halaman utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

// Route /dashboard utama (cek role user)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup route setelah login (mahasiswa & admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Formulir Pendaftaran (hanya mahasiswa)
    Route::get('/formulir-pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/formulir-pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});

// Grup route ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Program Studi
    Route::resource('program-studi', ProgramStudiController::class);

    // CRUD Pendaftaran
    Route::get('/pendaftar', [AdminPendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{pendaftaran}/edit', [AdminPendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    Route::post('/pendaftaran/{pendaftaran}/verifikasi', [AdminPendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');

    // CRUD Mata Kuliah
    Route::resource('matakuliah', MatakuliahController::class);

    // CRUD Jadwal Mata Kuliah
    Route::resource('jadwal', JadwalMatakuliahController::class);
});

// File yang mengatur route otentikasi (login, register, dll)
require __DIR__ . '/auth.php';
