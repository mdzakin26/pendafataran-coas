<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Pendaftaran: {{ $pendaftaran->user->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebar')

        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Pendaftaran: <span class="font-normal">{{ $pendaftaran->user->name }}</span>
                </h2>
            </div>
        </header>

        <main>
            <div class="py-12">
                <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                            <form method="POST" action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}">
                                @csrf
                                @method('PUT') {{-- Method penting untuk update --}}

                                <div class="space-y-6">
                                    {{-- NAMA PENGGUNA (HANYA TAMPIL, TIDAK BISA DIEDIT) --}}
                                    <div>
                                        <x-input-label for="name" :value="__('Nama Pendaftar')" />
                                        <x-text-input id="name" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" :value="$pendaftaran->user->name" disabled />
                                    </div>

                                    {{-- PROGRAM STUDI --}}
                                    <div>
                                        <x-input-label for="program_studi_id" :value="__('Program Studi')" />
                                        <select id="program_studi_id" name="program_studi_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            @foreach($programStudis as $prodi)
                                            <option value="{{ $prodi->id }}" @if($pendaftaran->program_studi_id == $prodi->id) selected @endif>
                                                {{ $prodi->nama_prodi }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('program_studi_id')" class="mt-2" />
                                    </div>

                                    {{-- ALAMAT --}}
                                    <div>
                                        <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                                        <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('alamat', $pendaftaran->alamat) }}</textarea>
                                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                    </div>

                                    {{-- NOMOR TELEPON --}}
                                    <div>
                                        <x-input-label for="no_telepon" :value="__('Nomor Telepon')" />
                                        <x-text-input id="no_telepon" class="block mt-1 w-full" type="text" name="no_telepon" :value="old('no_telepon', $pendaftaran->user->no_telepon)" disabled />
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nomor telepon diambil dari data user dan tidak bisa diubah di sini.</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Batal</a>
                                    <x-primary-button class="ms-4">
                                        Simpan Perubahan
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>