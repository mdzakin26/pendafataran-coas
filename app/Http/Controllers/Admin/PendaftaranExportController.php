<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\PendaftaranExport;

class PendaftaranExportController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new PendaftaranExport, 'data_pendaftaran.xlsx');
    }
}
