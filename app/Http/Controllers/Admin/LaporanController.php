<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil pendaftar (untuk tabel)
        $pendaftarans = Pendaftaran::with(['user', 'programStudi', 'matakuliah'])
            ->latest()
            ->paginate(10); // paginate agar tabel lebih ringan

        // Ringkasan status
        $ringkasan = [
            'pending'      => Pendaftaran::where('status', 'pending')->count(),
            'diverifikasi' => Pendaftaran::where('status', 'diverifikasi')->count(),
            'ditolak'      => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        // 1) Data untuk grafik status (labelsStatus, valuesStatus)
        $labelsStatus = ['Pending', 'Diverifikasi', 'Ditolak'];
        $valuesStatus = [
            $ringkasan['pending'],
            $ringkasan['diverifikasi'],
            $ringkasan['ditolak'],
        ];

        // 2) Data untuk grafik mingguan: 7 minggu terakhir (labelsMinggu, valuesMinggu)
        $labelsMinggu = [];
        $valuesMinggu = [];
        for ($i = 6; $i >= 0; $i--) {
            $start = Carbon::now()->subWeeks($i)->startOfWeek();
            $end = Carbon::now()->subWeeks($i)->endOfWeek();

            $labelsMinggu[] = $start->format('d M') . ' - ' . $end->format('d M');
            $valuesMinggu[] = Pendaftaran::whereBetween('created_at', [$start, $end])->count();
        }

        // 3) Data untuk grafik program studi (labelsProdi, valuesProdi)
        $prodiData = Pendaftaran::selectRaw('program_studi_id, COUNT(*) as total')
            ->groupBy('program_studi_id')
            ->with('programStudi')
            ->get();

        // Jika tidak ada program studi (null), hindari error dengan fallback
        $labelsProdi = $prodiData->map(function ($row) {
            return $row->programStudi->nama_prodi ?? 'Tidak Diketahui';
        })->toArray();

        $valuesProdi = $prodiData->pluck('total')->toArray();

        return view('admin.laporan.index', compact(
            'pendaftarans',
            'ringkasan',
            'labelsStatus',
            'valuesStatus',
            'labelsMinggu',
            'valuesMinggu',
            'labelsProdi',
            'valuesProdi'
        ));
    }
}
