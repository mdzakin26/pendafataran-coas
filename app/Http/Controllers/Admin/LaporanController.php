<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftaranExport;

use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // TABEL
        $pendaftarans = Pendaftaran::with(['user', 'programStudi', 'matakuliah','dokumens'])
            ->latest()
            ->paginate(10);

        // RINGKASAN
        $ringkasan = [
            'pending'      => Pendaftaran::where('status', 'pending')->count(),
            'diverifikasi' => Pendaftaran::where('status', 'diverifikasi')->count(),
            'ditolak'      => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        // CHART STATUS
        $labelsStatus = ['Pending', 'Diverifikasi', 'Ditolak'];
        $valuesStatus = [
            $ringkasan['pending'],
            $ringkasan['diverifikasi'],
            $ringkasan['ditolak'],
        ];

        // CHART MINGGU
        $labelsMinggu = [];
        $valuesMinggu = [];

        for ($i = 6; $i >= 0; $i--) {
            $start = Carbon::now()->subWeeks($i)->startOfWeek();
            $end = Carbon::now()->subWeeks($i)->endOfWeek();

            $labelsMinggu[] = $start->format('d M') . ' - ' . $end->format('d M');
            $valuesMinggu[] = Pendaftaran::whereBetween('created_at', [$start, $end])->count();
        }

        return view('admin.laporan.index', compact(
            'pendaftarans',
            'ringkasan',
            'labelsStatus',
            'valuesStatus',
            'labelsMinggu',
            'valuesMinggu'
        ));
    }

    public function export()
{
    return Excel::download(new PendaftaranExport, 'laporan_pendaftar.xlsx');
}
}
