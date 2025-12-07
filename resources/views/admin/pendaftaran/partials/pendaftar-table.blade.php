<div class="w-full">
    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2">Program Studi</th>
                <th class="px-4 py-2">Mata Kuliah</th>
                <th class="px-4 py-2">Jadwal</th>
                <th class="px-4 py-2">Tanggal Daftar</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>

        <tbody class="bg-white dark:bg-gray-800">
            @foreach ($pendaftarans as $p)
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-2">{{ $p->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $p->programStudi->nama_prodi ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $p->mataKuliah->nama ?? '-' }}</td>
                    <td class="px-4 py-2">
                        {{ $p->jadwal->hari ?? '-' }},
                        {{ $p->jadwal->jam_mulai ?? '-' }} -
                        {{ $p->jadwal->jam_selesai ?? '-' }}
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>

                    <td class="px-4 py-2">
                        @if ($p->status === 'pending')
                            <span class="px-3 py-1 rounded-full bg-yellow-200 text-yellow-800 text-sm">Pending</span>
                        @elseif ($p->status === 'diverifikasi')
                            <span class="px-3 py-1 rounded-full bg-green-200 text-green-800 text-sm">DiTerima</span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-red-200 text-red-800 text-sm">Ditolak</span>
                        @endif
                    </td>

                    <td class="px-4 py-2">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.pendaftaran.show', $p->id) }}"
                                class="text-blue-400 hover:underline">Detail</a>

                            <a href="{{ route('admin.pendaftaran.edit', $p->id) }}"
                                class="text-yellow-400 hover:underline">Edit</a>

                            <form action="{{ route('admin.pendaftaran.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
