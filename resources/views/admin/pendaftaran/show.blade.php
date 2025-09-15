<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pendaftar: {{ $pendaftaran->user->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebar')

        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    {{-- Judul di Kiri --}}
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Detail Pendaftaran: <span class="font-normal">{{ $pendaftaran->user->name }}</span>
                    </h2>

                    {{-- Tombol Aksi di Kanan --}}
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.pendaftaran.edit', $pendaftaran->id) }}" class="px-3 py-1 bg-yellow-500 text-white font-semibold rounded-md text-xs hover:bg-yellow-600 transition">
                            Edit Data
                        </a>
                        <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus pendaftaran ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white font-semibold rounded-md text-xs hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                                        Informasi Pendaftar
                                    </h3>
                                    <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->user->name }}</dd>
                                        </div>
                                        
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->user->email }}</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->user->no_telepon }}</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->user->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->user->tanggal_lahir)->format('d F Y') : '-' }}</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Asal Program Studi </dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->programStudi->nama_prodi }}</dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Mata Kuliah Pilihan</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->matakuliah->nama }}</dd>

                                        </div>
                                        
                                        <div class="sm:col-span-2">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $pendaftaran->alamat }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                                        Dokumen Terlampir
                                    </h3>
                                    <ul role="list" class="mt-4 border-t border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($pendaftaran->dokumens as $dokumen)
                                        <li class="flex items-center justify-between py-3">
                                            <div class="flex items-center">
                                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m-1.125 0H5.625A2.25 2.25 0 003.375 7.5v11.25c0 .621.504 1.125 1.125 1.125h9.75M8.25 2.25h.375a3.375 3.375 0 013.375 3.375v1.5a1.125 1.125 0 001.125 1.125h1.5a3.375 3.375 0 013.375 3.375M12.75 19.5h-5.25" />
                                                </svg>
                                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $dokumen->tipe_dokumen }}</span>
                                            </div>
                                            <a href="{{ route('dokumen.show', basename($dokumen->path_file)) }}" target="_blank" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">Lihat/Unduh</a>
                                        </li>
                                        @empty
                                        <li class="py-3 text-sm text-gray-500">Tidak ada dokumen terlampir.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <form method="POST" action="{{ route('admin.pendaftaran.verifikasi', $pendaftaran->id) }}">
                                    @csrf
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">Aksi Verifikasi</h3>
                                        <div class="mt-4">
                                            <x-input-label for="status" value="Ubah Status Pendaftaran" />
                                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                                <option value="diverifikasi" @if($pendaftaran->status == 'diverifikasi') selected @endif>Diverifikasi (Terima)</option>
                                                <option value="ditolak" @if($pendaftaran->status == 'ditolak') selected @endif>Ditolak</option>
                                                <option value="pending" @if($pendaftaran->status == 'pending') selected @endif>Kembalikan ke Pending</option>
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <x-input-label for="catatan_admin" value="Catatan untuk Mahasiswa (Wajib jika ditolak)" />
                                            <textarea id="catatan_admin" name="catatan_admin" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('catatan_admin', $pendaftaran->catatan_admin) }}</textarea>
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
        </main>
    </div>
</body>

</html>