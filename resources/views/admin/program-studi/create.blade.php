<x-app-layout>
    <x-slot name="title">
        Tambah Pendaftaran
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Program Studi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <div class="mb-8 border-b pb-4 border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                            Tambah Program Studi Baru
                        </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Isi detail program studi baru yang akan dibuka untuk pendaftaran.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.program-studi.store') }}">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="nama_prodi" :value="__('Nama Program Studi')" />
                                <x-text-input id="nama_prodi" class="block mt-1 w-full" type="text" name="nama_prodi" :value="old('nama_prodi')" required autofocus />
                                <x-input-error :messages="$errors->get('nama_prodi')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="fakultas" :value="__('Fakultas')" />
                                    <x-text-input id="fakultas" class="block mt-1 w-full" type="text" name="fakultas" :value="old('fakultas')" required />
                                    <x-input-error :messages="$errors->get('fakultas')" class="mt-2" />
                                </div>

                                {{-- <div>
                                    <x-input-label for="biaya_pendaftaran" :value="__('Biaya Pendaftaran (Rp)')" />
                                    <div class="relative mt-1">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <x-text-input id="biaya_pendaftaran" class="block w-full pl-8" type="number" name="biaya_pendaftaran" :value="old('biaya_pendaftaran')" required placeholder="250000" />
                                    </div>
                                    <x-input-error :messages="$errors->get('biaya_pendaftaran')" class="mt-2" />
                                </div> --}}
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.program-studi.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Program Studi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>