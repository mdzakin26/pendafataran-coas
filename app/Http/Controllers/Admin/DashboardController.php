<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalPendaftar = Pendaftaran::count();
        $pendaftarPending = Pendaftaran::where('status', 'pending')->count();
        $pendaftarDiverifikasi = Pendaftaran::where('status', 'diverifikasi')->count();
        $pendaftarDitolak = Pendaftaran::where('status', 'ditolak')->count();

        // Pendaftar terbaru
        $pendaftarTerbaru = Pendaftaran::with('user', 'programStudi')
            ->latest()
            ->take(10)
            ->get();

        // Grafik jumlah pendaftaran per hari (7 hari terakhir)
        $pendaftaranPerHari = Pendaftaran::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7)) // ambil 7 hari terakhir
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'pendaftarPending',
            'pendaftarDiverifikasi',
            'pendaftarDitolak',
            'pendaftarTerbaru',
            'pendaftaranPerHari'
        ));
    }
}
