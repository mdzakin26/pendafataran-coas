<x-app-layout>
    <x-slot name="title">Tambah Mata Kuliah</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Mata Kuliah
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.matakuliah.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block">Kode</label>
                    <input type="text" name="kode" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block">Nama Mata Kuliah</label>
                    <input type="text" name="nama" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block">SKS</label>
                    <input type="number" name="sks" class="w-full border rounded p-2" required>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
