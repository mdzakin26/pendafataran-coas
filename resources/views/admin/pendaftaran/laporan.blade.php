<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Ringkasan Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 bg-yellow-50 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-sm font-semibold">Menunggu Verifikasi</h3>
                    <p class="text-3xl font-bold mt-2">{{ $ringkasan['pending'] }}</p>
                </div>
                <div class="p-6 bg-green-50 dark:bg-green-900 text-green-800 dark:text-green-300 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-sm font-semibold">Diterima</h3>
                    <p class="text-3xl font-bold mt-2">{{ $ringkasan['diterima'] }}</p>
                </div>
                <div class="p-6 bg-red-50 dark:bg-red-900 text-red-800 dark:text-red-300 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-sm font-semibold">Ditolak</h3>
                    <p class="text-3xl font-bold mt-2">{{ $ringkasan['ditolak'] }}</p>
                </div>
            </div>

            {{-- Tabel Data Pendaftar --}}
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Pendaftar</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Program Studi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($pendaftarans as $p)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $p->user->name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $p->programStudi->nama_prodi ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $p->matakuliah->nama ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($p->status == 'pending')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">Pending</span>
                                            @elseif($p->status == 'diverifikasi')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Diterima</span>
                                            @elseif($p->status == 'ditolak')
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $p->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($pendaftarans->isEmpty())
                            <p class="text-center text-gray-500 dark:text-gray-400 py-4">Belum ada data pendaftar.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
