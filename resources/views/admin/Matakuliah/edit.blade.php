<x-app-layout>
    <x-slot name="title">Edit Mata Kuliah</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Mata Kuliah
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.matakuliah.update', $matakuliah->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Kode --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium">Kode</label>
                        <input 
                            type="text" 
                            name="kode" 
                            value="{{ old('kode', $matakuliah->kode) }}"
                            required
                            class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 
                                rounded-md bg-white dark:bg-gray-700
                                text-gray-900 dark:text-gray-100
                                focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        @error('kode')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Mata Kuliah --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium">Nama Mata Kuliah</label>
                        <input 
                            type="text" 
                            name="nama_matakuliah" 
                            value="{{ old('nama_matakuliah', $matakuliah->nama) }}"
                            required
                            class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 
                                rounded-md bg-white dark:bg-gray-700
                                text-gray-900 dark:text-gray-100
                                focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        @error('nama_matakuliah')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- SKS --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium">SKS</label>
                        <input 
                            type="number" 
                            name="sks" 
                            value="{{ old('sks', $matakuliah->sks) }}"
                            required
                            class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 
                                rounded-md bg-white dark:bg-gray-700
                                text-gray-900 dark:text-gray-100
                                focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        @error('sks')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end">
                        <a 
                            href="{{ route('admin.matakuliah.index') }}" 
                            class="mr-3 text-gray-600 dark:text-gray-400 hover:underline"
                        >
                            Batal
                        </a>

                        <button 
                            class="bg-indigo-600 hover:bg-indigo-700 
                                text-white px-4 py-2 rounded-md 
                                focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>
