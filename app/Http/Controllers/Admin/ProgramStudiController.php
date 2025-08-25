<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Menampilkan Daftar Program Studi
     */
    public function index()
    {
        $programStudis = ProgramStudi::latest()->get();
        return view('admin.program-studi.index', compact('programStudis'));
    }

    /**
     * Menampilkan form untuk membuat prodi baru
     */
    public function create()
    {
        // View in akan berisi form kosong 
        return view('admin.program-studi.create');
    }

    /**
     * Menyimpan prodi baru ke database
     */
    public function store(Request $request)
    {
        //Validasi Input
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:program_studis',
            'fakultas' => 'required|string|max:255',
            // 'biaya_pendaftaran' => 'required|integer|min:0',
        ]);

        // Buat data baru
        ProgramStudi::create($request->all());

        // Require ke halaman index dengan pesan sukses
        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi Berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu prodi (opsional, sering tidak digunakan jika data sudah lengkap index.)
     */
    public function show(ProgramStudi $programStudi)
    {
        // Laravel secara otomatis akan mencari ProgramStudi berdasarkan id di URL
        return view('admin.program-studi.show', compact('programStudi'));
    }

    /**
     * Menyimpan perubahan dari form edit ke database.
     */
    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    /**
     * Menyimpan perubahan dari form edit ke database.
     */
    public function update(Request $request, ProgramStudi $programStudi)
    {
        // Validasi input, dengan aturan "unique" yang membagikan data saat ini
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:program_studis,nama_prodi,' . $programStudi->id,
            'fakultas' => 'required|string|max:255',
            // 'biaya_pendaftaran' => 'required|integer|min:0',
        ]);

        // Update data yang ada
        $programStudi->update($request->all());

        // Redirect ke halaman index dengan pesan akses
        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Menghapus prodi data database.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        // Hapus data 
        $programStudi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.program-studi.index')->with('success', 'Program Studi Berhasil Dihapus');
    }
}
