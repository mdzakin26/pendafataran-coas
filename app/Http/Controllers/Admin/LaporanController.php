<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Data pendaftaran
        $pendaftarans = Pendaftaran::with(['user', 'programStudi', 'matakuliah'])
            ->latest()
            ->get();

        // Ringkasan status
        $ringkasan = [
            'pending'      => Pendaftaran::where('status', 'pending')->count(),
            'diverifikasi' => Pendaftaran::where('status', 'diverifikasi')->count(),
            'ditolak'      => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        // Grafik pendaftaran per minggu
        $dataPerMinggu = Pendaftaran::select(
                DB::raw('YEARWEEK(created_at, 1) as minggu'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('minggu')
            ->orderBy('minggu', 'asc')
            ->limit(7)
            ->get();

        // Siapkan label + value untuk Chart.js
        $labels = $dataPerMinggu->map(function ($item) {
            return 'Minggu ' . substr($item->minggu, -2);
        });

        $values = $dataPerMinggu->pluck('total');

        return view('admin.laporan.index', [
            'pendaftarans' => $pendaftarans,
            'ringkasan'    => $ringkasan,
            'labels'       => $labels,
            'values'       => $values
        ]);
    }
}
