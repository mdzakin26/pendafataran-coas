<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalMatakuliahController extends Controller
{
    /**
     * Menampilkan daftar jadwal.
     */
    public function index()
    {
        $jadwals = Jadwal::with('matakuliah')->latest()->paginate(10);
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Form tambah jadwal.
     */
    public function create()
    {
        $matakuliahs = Matakuliah::all();
        return view('admin.jadwal.create', compact('matakuliahs'));
    }

    /**
     * Simpan jadwal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'semester' => 'required|integer|min:1|max:14',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'nullable|string'
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Form edit jadwal.
     */
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $matakuliahs = Matakuliah::all();

        return view('admin.jadwal.edit', compact('jadwal', 'matakuliahs'));
    }

    /**
     * Update jadwal.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'semester' => 'required|integer|min:1|max:14',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'nullable|string'
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Hapus jadwal.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
