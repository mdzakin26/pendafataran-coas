{{-- resources/views/admin/pendaftaran/partials/pendaftar-table.blade.php --}}
<div class="overflow-x-auto mt-6">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Program Studi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Mata Kuliah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jadwal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal Daftar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                <th class="relative px-6 py-3"></th>
            </tr>
        </thead>

        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($pendaftarans as $pendaftaran)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                {{-- Nama Mahasiswa --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ $pendaftaran->user->name ?? '-' }}
                </td>

                {{-- Program Studi --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                    {{ $pendaftaran->programStudi->nama_prodi ?? '-' }}
                </td>

                {{-- Mata Kuliah --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                    {{ $pendaftaran->matakuliah->nama ?? '-' }}
                </td>

                {{-- Jadwal --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                    @if ($pendaftaran->jadwal)
                        {{ $pendaftaran->jadwal->hari }},
                        {{ $pendaftaran->jadwal->jam_mulai }} - {{ $pendaftaran->jadwal->jam_selesai }}
                    @else
                        -
                    @endif
                </td>

                {{-- Tanggal Daftar --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                    {{ $pendaftaran->created_at->format('d M Y') }}
                </td>

                {{-- Status --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @if($pendaftaran->status == 'pending')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                    @elseif($pendaftaran->status == 'diverifikasi')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diverifikasi</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                    @endif
                </td>

                {{-- Tombol Detail --}}
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" 
                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                       Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $pendaftarans->links() }}
</div>
