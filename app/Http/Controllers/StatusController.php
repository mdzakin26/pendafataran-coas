<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * Menampilkan status pendaftaran mahasiswa
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['programStudi', 'matakuliah', 'jadwal'])
            ->where('user_id', Auth::id())
            ->first();

        if (!$pendaftaran) {
            return redirect()->route('pendaftaran.create')
                ->with('error', 'Anda belum melakukan pendaftaran.');
        }

        return view('mahasiswa.status', compact('pendaftaran'));
    }
}
