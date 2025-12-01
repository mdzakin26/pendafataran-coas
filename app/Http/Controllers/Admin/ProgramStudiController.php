<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudis = ProgramStudi::latest()->get();
        return view('admin.program-studi.index', compact('programStudis'));
    }

    public function create()
    {
        return view('admin.program-studi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:program_studis',
            'fakultas' => 'required|string|max:255',
            
        ]);

        ProgramStudi::create($request->all());

        return redirect()->route('admin.program-studi.index')
                         ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:program_studis,nama_prodi,' . $programStudi->id,
            'fakultas' => 'required|string|max:255',
            'biaya_pendaftaran' => 'required|integer|min:0',
        ]);

        $programStudi->update($request->all());

        return redirect()->route('admin.program-studi.index')
                         ->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();

        return redirect()->route('admin.program-studi.index')
                         ->with('success', 'Program Studi berhasil dihapus.');
    }
}
