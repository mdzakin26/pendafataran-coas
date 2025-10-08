<x-app-layout>
    @php
        $pendaftaran = \App\Models\Pendaftaran::with('programStudi')
            ->where('user_id', auth()->id())
            ->first();
    @endphp

    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-4">
        <div class="max-w-md w-full">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-center">

                    {{-- Ikon header --}}
                    <div class="flex justify-center mb-4">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-full">
                            <span class="text-indigo-600 dark:text-indigo-300 text-3xl">📄</span>
                        </div>
                    </div>

                    {{-- Kondisi status pendaftaran --}}
                    @if ($pendaftaran)
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Pendaftaran Ditemukan
                        </h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                            Anda telah mendaftar pada program studi:
                        </p>
                        <p class="mt-1 text-indigo-600 dark:text-indigo-400 font-semibold">
                            {{ $pendaftaran->programStudi->nama_prodi ?? '-' }}
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('mahasiswa.status') }}"
                                class="inline-block px-5 py-2.5 rounded-md bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                                Lihat Status Pendaftaran
                            </a>
                        </div>
                    @else
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Belum Ada Pendaftaran
                        </h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                            Silakan lengkapi formulir untuk memulai proses pendaftaran Anda.
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('pendaftaran.create') }}"
                                class="inline-block px-5 py-2.5 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
                                Lengkapi Formulir
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
