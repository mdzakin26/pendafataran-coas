<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\ProgramStudi;
use App\Notifications\StatusPendaftaranUpdated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Models\Dokumen;


class PendaftaranController extends Controller
{

    public function index(Request $request)
    {
        // Ambil keyword pencarian dan status filter dari URL
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Pendaftaran::with('user', 'programStudi');

        // Jika ada keyword pencarian, filter berdasarkan nama atau email user
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Jika ada filter status, filter berdasarkan status
        if ($status) {
            $query->where('status', $status);
        }

        $pendaftarans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.index', compact('pendaftarans', 'search', 'status'));
    }
    /**
     * Menampilkan detail pendaftaran.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //  Menambahkan load() untuk Eager Loading agar lebih efisien
        // Ini memastikan data relasi (user, prodi, dokumens) diambil dalam satu query.
        $pendaftaran->load('user', 'programStudi', 'dokumens');

        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Memproses aksi verifikasi atau tolak.
     */
    public function verifikasi(Request $request, Pendaftaran $pendaftaran)
    {
        // Validasi input dari form
        $request->validate([
            'status' => ['required', Rule::in(['diverifikasi', 'ditolak', 'pending'])],
            'catatan_admin' => 'required_if:status,ditolak|nullable|string|max:1000',
        ]);

        // Update data pendaftaran di database
        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $pesanSukses = 'Status pendaftaran untuk ' . $pendaftaran->user->name . ' telah berhasil diupdate.';

        // PERBAIKAN: Menambahkan kondisi agar notifikasi tidak dikirim jika statusnya 'pending'
        if ($request->status !== 'pending') {
            try {
                $pendaftaran->user->notify(new StatusPendaftaranUpdated($pendaftaran));
                $pesanSukses .= ' Notifikasi telah dikirim.';
            } catch (\Exception $e) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Status berhasil diupdate, tetapi notifikasi email gagal dikirim. Error: ' . $e->getMessage());
            }
        }

        // Redirect kembali ke dashboard admin dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', $pesanSukses);
    }

    /**
     * Menampilkan form untuk mengedit data pendaftaran.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        $programStudis = ProgramStudi::all();
        return view('admin.pendaftaran.edit', compact('pendaftaran', 'programStudis'));
    }

    /**
     * Menyimpan perubahan dari form edit.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'program_studi_id' => 'required|exists:program_studis,id',
            'alamat' => 'required|string|max:255',
        ]);

        $pendaftaran->update($request->all());

        return redirect()->route('admin.pendaftaran.show', $pendaftaran->id)->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Menghapus data pendaftaran dari database.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        foreach ($pendaftaran->dokumens as $dokumen) {
            // Menghapus file fisik dari storage
            Storage::delete($dokumen->path_file);
        }

        // Menghapus data dari database
        $pendaftaran->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data pendaftar berhasil dihapus secara permanen.');
    }

    public function viewDokumen($id)
{
    $dokumen = Dokumen::findOrFail($id);

    $path = 'dokumen/' . $dokumen->path_file;

    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File tidak ditemukan.');
    }

    // buka langsung di browser
    return response()->file(storage_path('app/public/' . $path));
}

    public function downloadDokumen($id)
    {
        // cari dokumen berdasarkan id
        $dokumen = Dokumen::findOrFail($id);

        // path file di storage
        $path = 'dokumens/' . $dokumen->path_file;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // download dengan nama asli
        return Storage::disk('public')->download($path, $dokumen->nama_file ?? basename($dokumen->path_file));
    }

    public function laporan()
{
    $pendaftarans = \App\Models\Pendaftaran::with('user', 'programStudi', 'matakuliah', 'jadwal')->get();

    // Data ringkasan untuk dashboard laporan
    $ringkasan = [
        'pending'   => $pendaftarans->where('status', 'pending')->count(),
        'diterima'  => $pendaftarans->where('status', 'diverifikasi')->count(),
        'ditolak'   => $pendaftarans->where('status', 'ditolak')->count(),
    ];

    return view('admin.pendaftaran.laporan', compact('pendaftarans', 'ringkasan'));
}
}
