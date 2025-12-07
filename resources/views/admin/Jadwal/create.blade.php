<x-app-layout>
    <x-slot name="title">Tambah Jadwal</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Jadwal Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <!-- Header Form -->
                    <div class="mb-8 border-b pb-4 border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                            Tambah Jadwal Kuliah Baru
                        </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Lengkapi data jadwal perkuliahan berikut dengan benar.
                        </p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.jadwal.store') }}">
                        @csrf

                        <div class="space-y-6">
                            <!-- Mata Kuliah -->
                            <div>
                                <x-input-label for="matakuliah_id" :value="__('Mata Kuliah')" />
                                <select id="matakuliah_id" name="matakuliah_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($matakuliahs as $matkul)
                                        <option value="{{ $matkul->id }}">{{ $matkul->nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('matakuliah_id')" class="mt-2" />
                            </div>

                            <!-- Semester -->
                            <div>
                                <x-input-label for="semester" :value="__('Semester')" />
                                <select id="semester" name="semester"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @for($i = 3; $i <= 8; $i++)
                                        <option value="{{ $i }}">Semester {{ $i }}</option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>

                            <!-- Hari -->
                            <div>
                                <x-input-label for="hari" :value="__('Hari')" />
                                <select id="hari" name="hari"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                                <x-input-error :messages="$errors->get('hari')" class="mt-2" />
                            </div>

                            <!-- Jam Mulai & Jam Selesai -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="jam_mulai" :value="__('Jam Mulai')" />
                                    <x-text-input id="jam_mulai" type="time" name="jam_mulai" :value="old('jam_mulai')" class="block mt-1 w-full" required />
                                    <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="jam_selesai" :value="__('Jam Selesai')" />
                                    <x-text-input id="jam_selesai" type="time" name="jam_selesai" :value="old('jam_selesai')" class="block mt-1 w-full" required />
                                    <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Ruang -->
                            <div>
                                <x-input-label for="ruang" :value="__('Ruang')" />
                                <x-text-input id="ruang" type="text" name="ruang" :value="old('ruang')" class="block mt-1 w-full" required />
                                <x-input-error :messages="$errors->get('ruang')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.jadwal.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Jadwal') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
