<x-app-layout>
    <x-slot name="title">Edit Mata Kuliah</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Mata Kuliah
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.matakuliah.update', $matakuliah->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block">Kode</label>
                    <input type="text" name="kode" class="w-full border rounded p-2" value="{{ $matakuliah->kode }}" required>
                </div>
                <div class="mb-4">
                    <label class="block">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matakuliah" class="w-full border rounded p-2" value="{{ $matakuliah->nama_matakuliah }}" required>
                </div>
                <div class="mb-4">
                    <label class="block">SKS</label>
                    <input type="number" name="sks" class="w-full border rounded p-2" value="{{ $matakuliah->sks }}" required>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
