<x-app-layout>
    <x-slot name="title">
        Dashboard Pendaftaran
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulir Pendaftaran Mahasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Ada beberapa kesalahan dengan input Anda.</span>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="program_studi_id" :value="__('Pilih Program Studi')" />
                            <select id="program_studi_id" name="program_studi_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="" disabled selected>-- Pilih Program Studi --</option>
                                @forelse($programStudis as $prodi)
                                <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                                @empty
                                <option value="" disabled>-- Tidak ada program studi tersedia --</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('program_studi_id')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="dokumen_cv" :value="__('Upload Scan CV atau Portofolio (PDF/JPG/PNG, max: 2MB)')" />
                            <input id="dokumen_cv" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/50 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100" type="file" name="dokumen_cv" required />
                            <x-input-error :messages="$errors->get('dokumen_cv')" class="mt-2" />
                        </div>

                        {{-- <div class="mt-6">
                            <x-input-label for="dokumen_ijazah" :value="__('Upload Scan Ijazah Terakhir (PDF/JPG/PNG, max: 2MB)')" />
                            <input id="dokumen_ijazah" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/50 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100" type="file" name="dokumen_ijazah" required />
                            <x-input-error :messages="$errors->get('dokumen_ijazah')" class="mt-2" />
                        </div> --}}

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button>
                                {{ __('Kirim Pendaftaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>