<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\ProgramStudi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
            $pendaftarans = Pendaftaran::with(['user', 'programStudi', 'matakuliah','dokumens'])
            ->latest()
            ->paginate(10);
        // ============================
        // RINGKASAN PENDAFTAR
        // ============================
        $totalPendaftar     = Pendaftaran::count();
        $totalPending       = Pendaftaran::where('status', 'pending')->count();
        $totalDiverifikasi  = Pendaftaran::where('status', 'diverifikasi')->count();
        $totalDitolak       = Pendaftaran::where('status', 'ditolak')->count();

        // ============================
        // DATA PENDAFTAR PER PRODI
        // ============================
        $pendaftarPerProdi = ProgramStudi::select('nama_prodi')
            ->withCount('pendaftarans') // JIKA relasi ada
            ->get();

        // Jika relasi belum ada, gunakan query manual
        if ($pendaftarPerProdi->isEmpty()) {
            $pendaftarPerProdi = ProgramStudi::all()->map(function ($prodi) {
                return [
                    'nama_prodi' => $prodi->nama_prodi,
                    'pendaftaran_count' => Pendaftaran::where('program_studi_id', $prodi->id)->count(),
                ];
            });
        }

        // ============================
        // GRAFIK MINGGUAN (7 MINGGU)
        // ============================
        $labelsMinggu = [];
        $valuesMinggu = [];

        for ($i = 6; $i >= 0; $i--) {
            $start = Carbon::now()->subWeeks($i)->startOfWeek();
            $end   = Carbon::now()->subWeeks($i)->endOfWeek();

            $labelsMinggu[] = $start->format('d M') . ' - ' . $end->format('d M');
            $valuesMinggu[] = Pendaftaran::whereBetween('created_at', [$start, $end])->count();
        }

        return view('kaprodi.dashboard', compact(
            'totalPendaftar',
            'totalPending',
            'totalDiverifikasi',
            'totalDitolak',
            'pendaftarPerProdi',
            'labelsMinggu',
            'valuesMinggu',
            'pendaftarans'
        ));
    }
}
