<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Jadwal Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Mata Kuliah --}}
                        <div>
                            <x-input-label for="matakuliah_id" :value="__('Mata Kuliah')" />
                            <select id="matakuliah_id" 
                                name="matakuliah_id"
                                class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 border-gray-300">
                                @foreach ($matakuliahs as $mk)
                                    <option value="{{ $mk->id }}" 
                                        {{ $jadwal->matakuliah_id == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('matakuliah_id')" class="mt-2" />
                        </div>

                        {{-- Semester --}}
                        <div class="mt-4">
                            <x-input-label for="semester" :value="__('Semester')" />
                            <x-text-input id="semester" class="block mt-1 w-full" 
                                          type="number" 
                                          name="semester" 
                                          :value="old('semester', $jadwal->semester)" 
                                          required />
                            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                        </div>

                        {{-- Hari --}}
                        <div class="mt-4">
                            <x-input-label for="hari" :value="__('Hari')" />
                            <x-text-input id="hari" class="block mt-1 w-full" 
                                          type="text" 
                                          name="hari" 
                                          :value="old('hari', $jadwal->hari)" 
                                          required />
                            <x-input-error :messages="$errors->get('hari')" class="mt-2" />
                        </div>

                        {{-- Jam Mulai --}}
                        <div class="mt-4">
                            <x-input-label for="jam_mulai" :value="__('Jam Mulai')" />
                            <x-text-input id="jam_mulai" class="block mt-1 w-full" 
                                          type="time" 
                                          name="jam_mulai" 
                                          :value="old('jam_mulai', $jadwal->jam_mulai)" 
                                          required />
                            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="mt-4">
                            <x-input-label for="jam_selesai" :value="__('Jam Selesai')" />
                            <x-text-input id="jam_selesai" class="block mt-1 w-full" 
                                          type="time" 
                                          name="jam_selesai" 
                                          :value="old('jam_selesai', $jadwal->jam_selesai)" 
                                          required />
                            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                        </div>

                        {{-- Ruangan --}}
                        <div class="mt-4">
                            <x-input-label for="ruang" :value="__('Ruang')" />
                            <x-text-input id="ruang" class="block mt-1 w-full" 
                                          type="text" 
                                          name="ruang" 
                                          :value="old('ruang', $jadwal->ruang)" />
                            <x-input-error :messages="$errors->get('ruang')" class="mt-2" />
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.jadwal.index') }}" 
                               class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Batal
                            </a>

                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
