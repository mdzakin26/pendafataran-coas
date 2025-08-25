<?php

// Import semua controller yang dibutuhkan
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk menampilkan file dokumen secara aman
Route::get('/dokumen-pendaftaran/{namafile}', function ($namafile) {
    $path = 'public/dokumen/' . $namafile;

    // BENAR: menggunakan method exists()
    if (!Storage::exists($path)) {
        abort(404);
    }

    return Storage::response($path);
})->name('dokumen.show');

// Route untuk halaman utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

// Route /dashboard utama yang cerdas (mengarahkan admin secara otomatis)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Grup untuk semua route yang HANYA bisa diakses setelah login (mahasiswa & admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk Formulir Pendaftaran (hanya untuk mahasiswa)
    Route::get('/formulir-pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/formulir-pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});


// Grup untuk semua route yang HANYA bisa diakses oleh ADMIN
// BENAR: name('admin.') dengan titik di akhir
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('program-studi', ProgramStudiController::class);


    Route::get('/pendaftar', [AdminPendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('pendaftaran.show');
    // BENAR: Menggunakan parameter {pendaftaran}
    Route::get('/pendaftaran/{pendaftaran}/edit', [AdminPendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/pendaftaran/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    Route::post('/pendaftaran/{pendaftaran}/verifikasi', [AdminPendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
});


// File yang mengatur route otentikasi (login, register, dll)
require __DIR__ . '/auth.php';
