<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Pendaftaran:
                <span class="font-normal">{{ $pendaftaran->user->name }}</span>
            </h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.pendaftaran.edit', $pendaftaran->id) }}"
                    class="px-3 py-1 bg-yellow-500 text-white font-semibold rounded-md text-xs hover:bg-yellow-600 transition">
                    Edit Data
                </a>
                <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST"
                    onsubmit="return confirm('Anda yakin ingin menghapus pendaftaran ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-1 bg-red-600 text-white font-semibold rounded-md text-xs hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Informasi Pendaftar --}}
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                Informasi Pendaftar
                            </h3>
                            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->user->name }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->user->email }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->user->no_telepon }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->user->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->user->tanggal_lahir)->format('d F Y') : '-' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Program Studi</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->programStudi->nama_prodi ?? '-' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Mata Kuliah Pilihan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->matakuliah->nama ?? '-' }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $pendaftaran->alamat }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    {{-- Dokumen --}}
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                Dokumen Terlampir
                            </h3>
                            <ul class="mt-4 border-t border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($pendaftaran->dokumens as $dokumen)
                                    <li class="flex items-center justify-between py-3">
                                        <div class="flex items-center">
                                            <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m-1.125 0H5.625A2.25 2.25 0 003.375 7.5v11.25c0 .621.504 1.125 1.125 1.125h9.75M8.25 2.25h.375a3.375 3.375 0 013.375 3.375v1.5a1.125 1.125 0 001.125 1.125h1.5a3.375 3.375 0 013.375 3.375M12.75 19.5h-5.25" />
                                            </svg>
                                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $dokumen->tipe_dokumen }}
                                            </span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.pendaftaran.dokumen.view', $dokumen->id) }}"
                                                target="_blank"
                                                class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-md hover:bg-green-700 transition">
                                                Lihat
                                            </a>
                                            <a href="{{ route('admin.pendaftaran.dokumen.download', $dokumen->id) }}"
                                                class="px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded-md hover:bg-indigo-700 transition">
                                                Unduh
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-3 text-sm text-gray-500">Tidak ada dokumen terlampir.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <form method="POST" action="{{ route('admin.pendaftaran.verifikasi', $pendaftaran->id) }}">
                            @csrf
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Aksi Verifikasi
                                </h3>
                                <div class="mt-4">
                                    <x-input-label for="status" value="Ubah Status Pendaftaran" />
                                    <select id="status" name="status"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="diverifikasi" @selected($pendaftaran->status == 'diverifikasi')>Diverifikasi (Terima)</option>
                                        <option value="ditolak" @selected($pendaftaran->status == 'ditolak')>Ditolak</option>
                                        <option value="pending" @selected($pendaftaran->status == 'pending')>Kembalikan ke Pending</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="catatan_admin" value="Catatan untuk Mahasiswa (Wajib jika ditolak)" />
                                    <textarea id="catatan_admin" name="catatan_admin" rows="4"
                                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan_admin', $pendaftaran->catatan_admin) }}</textarea>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3 text-right">
                                <x-primary-button>Update Status</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
