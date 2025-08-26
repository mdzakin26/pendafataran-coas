<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('pendaftaran.create',compact('programStudis'));
    }


    // Menyimpan data pendaftaran
    public function store(Request $request)
    {
        // Hapus 'no_telepon' dari validasi
        $request->validate([
            'program_studi_id' => 'required|exists:program_studis,id',
            'alamat' => 'required|string|max:255',
            'dokumen_cv' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // 'dokumen_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Hapus 'no_telepon' dari data yang disimpan
            $pendaftaran = Pendaftaran::create([
                'user_id' => Auth::id(),
                'program_studi_id' => $request->program_studi_id,
                'alamat' => $request->alamat,
                'status' => 'pending',
                'catatan_admin' => null,
            ]);

            // 2. Simpan Data Dokumen CV
            if ($request->hasFile('dokumen_cv')) {
                $path_cv = $request->file('dokumen_cv')->store('public/dokumen');
                $pendaftaran->dokumens()->create([
                    'tipe_dokumen' => 'CV',
                    'path_file' => $path_cv
                ]);
            }

            // // 3. Simpan Dokumen Ijazah
            // if ($request->hasFile('dokumen_ijazah')) {
            //     $path_ijazah = $request->file('dokumen_ijazah')->store('public/dokumen');
            //     $pendaftaran->dokumens()->create([
            //         'tipe_dokumen' => 'Ijazah',
            //         'path_file' => $path_ijazah
            //     ]);
            // }

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Pendaftaran Berhasil Dikirim! Data Anda sedang kami review.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalahan. Silakan Coba Lagi. Detail: ' . $e->getMessage());
            
        }
    }
}
