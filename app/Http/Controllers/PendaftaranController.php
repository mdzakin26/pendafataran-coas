<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\ProgramStudi;
use App\Models\Matakuliah;
use App\Models\Jadwal; // 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    // Menampilkan Halaman formulir
    public function create()
    {
        // Cek Jika User sudah mendaftar
        if (Auth::user()->pendaftaran) {
            return redirect()->route('dashboard')->with('error', 'Anda Sudah Mendaftar!');
        }

        $programStudis = ProgramStudi::all();
        $matakuliahs   = Matakuliah::all();
        $jadwals       = Jadwal::all(); 

        return view('pendaftaran.create', compact('programStudis', 'matakuliahs', 'jadwals'));
    }

    // Menyimpan data pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'program_studi_id' => 'required|exists:program_studis,id',
            'matakuliah_id'    => 'required|exists:matakuliahs,id',
            'jadwal_id'        => 'required|exists:jadwals,id', // 
            'alamat'           => 'required|string|max:255',
            'dokumen_cv'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        
        try {
            DB::beginTransaction();

            // Simpan data pendaftaran
            $pendaftaran = Pendaftaran::create([
                'user_id'         => Auth::id(),
                'program_studi_id'=> $request->program_studi_id,
                'matakuliah_id'   => $request->matakuliah_id,
                'jadwal_id'       => $request->jadwal_id, // 
                'alamat'          => $request->alamat,
                'status'          => 'pending',
                'catatan_admin'   => null,
            ]);

            // Simpan Dokumen CV
            if ($request->hasFile('dokumen_cv')) {
                $path_cv = $request->file('dokumen_cv')->store('public/dokumen');
                $pendaftaran->dokumens()->create([
                    'tipe_dokumen' => 'CV',
                    'path_file'    => $path_cv
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Pendaftaran Berhasil Dikirim! Data Anda sedang kami review.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalahan. Silakan Coba Lagi. Detail: ' . $e->getMessage());
        }
    }
    

}
