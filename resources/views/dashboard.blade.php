<x-app-layout>
    <x-slot name="title">
        Dashboard Pendaftaran
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Ini adalah halaman personal Anda. Pantau status pendaftaran dan kelola profil Anda di sini.</p>
                </div>
            </div>

            @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                <p class="font-bold">Sukses</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
            @endif

            @if(Auth::user()->pendaftaran)
            @php $pendaftaran = Auth::user()->pendaftaran; @endphp
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Status Pendaftaran Anda</h3>

                    @if($pendaftaran->status == 'diverifikasi')
                    <div class="p-6 text-center bg-green-50 dark:bg-green-900/50 border-2 border-green-500 rounded-lg">
                        <svg class="mx-auto h-16 w-16 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="mt-4 text-2xl font-semibold text-green-800 dark:text-green-300">Selamat! Pendaftaran Anda Diverifikasi.</h4>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Informasi lebih lanjut mengenai langkah selanjutnya akan kami kirimkan melalui email.</p>
                    </div>
                    @elseif($pendaftaran->status == 'ditolak')
                    <div class="p-6 text-center bg-red-50 dark:bg-red-900/50 border-2 border-red-500 rounded-lg">
                        <svg class="mx-auto h-16 w-16 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="mt-4 text-2xl font-semibold text-red-800 dark:text-red-300">Pendaftaran Anda Ditolak.</h4>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Mohon maaf, pendaftaran Anda belum dapat kami proses. <br> **Catatan Admin:** {{ $pendaftaran->catatan_admin ?? 'Tidak ada catatan.' }}</p>
                    </div>
                    @else
                    <div class="p-6 text-center bg-yellow-50 dark:bg-yellow-900/50 border-2 border-yellow-500 rounded-lg">
                        <svg class="mx-auto h-16 w-16 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="mt-4 text-2xl font-semibold text-yellow-800 dark:text-yellow-300">Pendaftaran Sedang Ditinjau.</h4>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Data Anda sudah kami terima dan sedang dalam proses verifikasi oleh tim admin. Mohon ditunggu.</p>
                    </div>
                    @endif
                </div>
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-center">
                <div class="p-10">
                    <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-gray-100">Anda Belum Melengkapi Pendaftaran</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Satu langkah lagi untuk menjadi bagian dari kami. Silakan lengkapi formulir pendaftaran.</p>
                    <div class="mt-6">
                        <a href="{{ route('pendaftaran.create') }}" class="inline-block bg-blue-600 text-white font-bold text-lg px-8 py-4 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">
                            Lengkapi Formulir Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>