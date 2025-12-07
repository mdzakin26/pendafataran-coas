<x-app-layout>
    @php
        $pendaftaran = \App\Models\Pendaftaran::with('programStudi')
            ->where('user_id', auth()->id())
            ->first();
    @endphp

    <div class="min-h-[calc(100vh-64px)] bg-gray-100 dark:bg-gray-900 px-6 py-10">

        {{-- HEADER --}}
        <div class="max-w-4xl mx-auto mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Selamat Datang, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                Berikut adalah ringkasan status pendaftaran Anda.
            </p>
        </div>

        {{-- STATUS CARD --}}
        <div class="max-w-4xl mx-auto mb-10">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">

                {{-- ICON --}}
                <div class="flex justify-center mb-6">
                    <div class="p-4 bg-indigo-100 dark:bg-indigo-900 rounded-full shadow">
                        <span class="text-indigo-600 dark:text-indigo-300 text-4xl">
                            {{ $pendaftaran ? '📘' : '📄' }}
                        </span>
                    </div>
                </div>

                {{-- CONTENT --}}
                @if ($pendaftaran)
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 text-center">
                        Pendaftaran Anda Telah Tercatat
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300 text-center">
                        Anda mendaftar pada program studi:
                    </p>
                    <p class="mt-3 text-indigo-600 dark:text-indigo-400 text-center font-bold text-lg">
                        {{ $pendaftaran->Matakuliah->nama ?? '-' }}
                    </p>

                    <div class="mt-6 flex justify-center">
                        <a href="{{ route('mahasiswa.status') }}"
                            class="px-6 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                            Lihat Status Pendaftaran
                        </a>
                    </div>
                @else
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 text-center">
                        Anda Belum Melakukan Pendaftaran
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300 text-center">
                        Klik tombol di bawah untuk memulai proses.
                    </p>

                    <div class="mt-6 flex justify-center">
                        <a href="{{ route('pendaftaran.create') }}"
                            class="px-6 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
                            Lengkapi Formulir
                        </a>
                    </div>
                @endif

            </div>
        </div>

        {{-- INFORMATION BOXES --}}
        <div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- BOX 1 --}}
            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                    📌 Status Saat Ini
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm">
                    {{ $pendaftaran ? 'Sedang dalam proses seleksi.' : 'Belum ada pendaftaran.' }}
                </p>
            </div>

            {{-- BOX 2 --}}
            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                    📆 Periode Pendaftaran
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm">
                    1 Februari – 20 Maret
                </p>
            </div>

            {{-- BOX 3 --}}
            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                    🔔 Pengumuman
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm">
                    Hasil seleksi akan diumumkan pada awal April.
                </p>
            </div>

        </div>

    </div>
</x-app-layout>
