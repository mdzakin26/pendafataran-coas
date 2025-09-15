<x-app-layout>
    <x-slot name="title">Daftar Jadwal</x-slot>

    <div class="max-w-6xl mx-auto mt-6">
        <a href="{{ route('admin.jadwal.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Jadwal</a>

        <table class="min-w-full mt-6 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Mata Kuliah</th>
                    <th class="px-4 py-2">Semester</th>
                    <th class="px-4 py-2">Hari</th>
                    <th class="px-4 py-2">Jam</th>
                    <th class="px-4 py-2">Ruang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                <tr>
                    <td class="px-4 py-2">{{ $jadwal->matakuliah->nama }}</td>
                    <td class="px-4 py-2">{{ $jadwal->semester }}</td>
                    <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                    <td class="px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td class="px-4 py-2">{{ $jadwal->ruang }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
