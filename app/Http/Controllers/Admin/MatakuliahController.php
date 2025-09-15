<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliahs = Matakuliah::latest()->paginate(10);
        return view('admin.matakuliah.index', compact('matakuliahs'));
    }

    public function create()
    {
        return view('admin.matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:50|unique:matakuliahs,kode',
        'nama' => 'required|string|max:255',
        'sks'  => 'required|integer|min:1|max:10',
        ]);

        Matakuliah::create([
           'kode' => $request->kode,
        'nama' => $request->nama,
        'sks'  => $request->sks,
        ]);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function edit(Matakuliah $matakuliah)
    {
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'kode' => 'required|string|max:50|unique:matakuliahs,kode,'.$matakuliah->id,
        'nama' => 'required|string|max:255',
        'sks'  => 'required|integer|min:1|max:10',
        ]);

        $matakuliah->update([
        'kode' => $request->kode,
        'nama' => $request->nama,
        'sks'  => $request->sks,
        ]);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
