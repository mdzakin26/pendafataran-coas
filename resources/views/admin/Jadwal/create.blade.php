<x-app-layout>
    <x-slot name="title">Tambah Jadwal</x-slot>

    <div class="max-w-3xl mx-auto mt-6">
        <form method="POST" action="{{ route('admin.jadwal.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Mata Kuliah</label>
                <select name="matakuliah_id" class="w-full border rounded p-2">
                    @foreach($matakuliahs as $matkul)
                        <option value="{{ $matkul->id }}">{{ $matkul->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Semester</label>
                <select name="semester" class="w-full border rounded p-2">
                    @for($i=1; $i<=14; $i++)
                        <option value="{{ $i }}">Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Hari</label>
                <select name="hari" class="w-full border rounded p-2">
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Ruang</label>
                <input type="text" name="ruang" class="w-full border rounded p-2">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
