<x-app-layout>
    <x-slot name="title">
        Tambah Mata Kuliah
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <div class="mb-8 border-b pb-4 border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                            Tambah Mata Kuliah Baru
                        </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Lengkapi data mata kuliah yang akan ditambahkan ke dalam sistem.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.matakuliah.store') }}">
                        @csrf

                        <div class="space-y-6">
                            <!-- Kode Mata Kuliah -->
                            <div>
                                <x-input-label for="kode" :value="__('Kode Mata Kuliah')" />
                                <x-text-input id="kode" class="block mt-1 w-full" type="text" name="kode" :value="old('kode')" required autofocus />
                                <x-input-error :messages="$errors->get('kode')" class="mt-2" />
                            </div>

                            <!-- Nama Mata Kuliah -->
                            <div>
                                <x-input-label for="nama" :value="__('Nama Mata Kuliah')" />
                                <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required />
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <!-- SKS -->
                            <div>
                                <x-input-label for="sks" :value="__('Jumlah SKS')" />
                                <x-text-input id="sks" class="block mt-1 w-full" type="number" name="sks" :value="old('sks')" required min="1" max="6" />
                                <x-input-error :messages="$errors->get('sks')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.matakuliah.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Mata Kuliah') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
