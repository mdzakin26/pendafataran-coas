<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Program Studi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.program-studi.update', $programStudi->id) }}">
                        @csrf
                        @method('PUT') {{-- Method spoofing untuk update --}}

                        <div>
                            <x-input-label for="nama_prodi" :value="__('Nama Program Studi')" />
                            <x-text-input id="nama_prodi" class="block mt-1 w-full" type="text" name="nama_prodi" :value="old('nama_prodi', $programStudi->nama_prodi)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_prodi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="fakultas" :value="__('Fakultas')" />
                            <x-text-input id="fakultas" class="block mt-1 w-full" type="text" name="fakultas" :value="old('fakultas', $programStudi->fakultas)" required />
                            <x-input-error :messages="$errors->get('fakultas')" class="mt-2" />
                        </div>

                        {{-- <div class="mt-4">
                            <x-input-label for="biaya_pendaftaran" :value="__('Biaya Pendaftaran')" />
                            <x-text-input id="biaya_pendaftaran" class="block mt-1 w-full" type="number" name="biaya_pendaftaran" :value="old('biaya_pendaftaran', $programStudi->biaya_pendaftaran)" required />
                            <x-input-error :messages="$errors->get('biaya_pendaftaran')" class="mt-2" />
                        </div> --}}

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.program-studi.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>