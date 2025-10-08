<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\ProgramStudi;
use App\Models\Dokumen;
use App\Notifications\StatusPendaftaranUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan daftar pendaftar dengan fitur pencarian & filter status.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Pendaftaran::with(['user', 'programStudi']);

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $pendaftarans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pendaftaran.index', compact('pendaftarans', 'search', 'status'));
    }

    /**
     * Tampilkan detail pendaftaran.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['user', 'programStudi', 'dokumens']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Verifikasi / tolak pendaftaran.
     */
    public function verifikasi(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => ['required', Rule::in(['diverifikasi', 'ditolak', 'pending'])],
            'catatan_admin' => 'required_if:status,ditolak|nullable|string|max:1000',
        ]);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $pesanSukses = 'Status pendaftaran untuk ' . $pendaftaran->user->name . ' berhasil diperbarui.';

        if ($request->status !== 'pending') {
            try {
                $pendaftaran->user->notify(new StatusPendaftaranUpdated($pendaftaran));
                $pesanSukses .= ' Notifikasi telah dikirim.';
            } catch (\Exception $e) {
                return back()->with('success', 'Status berhasil diupdate, tapi notifikasi gagal dikirim. Error: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.dashboard')->with('success', $pesanSukses);
    }

    /**
     * Form edit data pendaftaran.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        $programStudis = ProgramStudi::all();
        return view('admin.pendaftaran.edit', compact('pendaftaran', 'programStudis'));
    }

    /**
     * Simpan hasil edit data pendaftaran.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'program_studi_id' => 'required|exists:program_studis,id',
            'alamat' => 'required|string|max:255',
        ]);

        $pendaftaran->update($request->only(['program_studi_id', 'alamat']));

        return redirect()
            ->route('admin.pendaftaran.show', $pendaftaran->id)
            ->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Hapus data pendaftaran dan semua dokumennya.
     */
    /**
     * Lihat dokumen (khusus admin).
     */
    public function viewDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        // Ambil nama file dari path di database
        $filename = basename($dokumen->path_file);

        // Path file di storage private
        $filePath = storage_path('app/private/public/dokumen/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Tampilkan file langsung di browser (gambar/pdf/dll)
        return response()->file($filePath);
    }

    /**
     * Download dokumen (khusus admin).
     */
    public function downloadDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $filename = basename($dokumen->path_file);
        $filePath = storage_path('app/private/public/dokumen/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath);
    }

    



    /**
     * Laporan seluruh pendaftaran.
     */
    public function laporan()
    {
        $pendaftarans = Pendaftaran::with(['user', 'programStudi'])->get();

        $ringkasan = [
            'pending'       => $pendaftarans->where('status', 'pending')->count(),
            'diverifikasi'  => $pendaftarans->where('status', 'diverifikasi')->count(),
            'ditolak'       => $pendaftarans->where('status', 'ditolak')->count(),
        ];

        return view('admin.pendaftaran.laporan', compact('pendaftarans', 'ringkasan'));
    }
}
