<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        // Ambil data statistik
        $totalPendaftar = \App\Models\Pendaftaran::count();
        $pendaftarPending = \App\Models\Pendaftaran::where('status', 'pending')->count();
        $pendaftarDiverifikasi = \App\Models\Pendaftaran::where('status', 'diverifikasi')->count();
        $pendaftarDitolak = \App\Models\Pendaftaran::where('status', 'ditolak')->count();

        // Ambil 10 pendaftar terbaru untuk ditampilkan di tabel
        $pendaftarTerbaru = \App\Models\Pendaftaran::with('user', 'programStudi')
            ->latest()
            ->take(10)
            ->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalPendaftar',
            'pendaftarPending',
            'pendaftarDiverifikasi',
            'pendaftarDitolak',
            'pendaftarTerbaru'
        ));
    }
}

//         // BAGIAN INI MENGIRIMKAN $pendaftarans DAN $stats KE VIEW
//         return view('admin.dashboard', compact('pendaftarans', 'stats'));
//     }
// }