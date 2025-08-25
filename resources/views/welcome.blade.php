<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-g">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Co Assisten Dosen</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600">
                <img src="assets/logo-if.png" alt="" style="height:50px;">
            </a>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-semibold rounded-md">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-semibold rounded-md">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">Register</a>
                @endif
                @endauth
                @endif
            </div>
        </nav>
    </header>
    <main>
        <section class="bg-white pt-20 pb-10 lg:pt-32 lg:pb-20">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                            Selamat Datang di Sistem Pendaftaran  Assisten Dosen Di Informatika LPKIA
                        </h1>
                        <p class="mt-6 text-lg text-gray-600">
                            Proses pendaftaran yang mudah, cepat, dan transparan.
                        </p>
                        <div class="mt-8">
                            <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white font-bold text-lg px-8 py-4 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <img src="assets/lpk-removebg-preview.png" alt="Mahasiswa Ceria" class="">
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900">Kenapa Memilih Kami?</h2>
                    <p class="mt-4 text-lg text-gray-600">Sistem kami dirancang untuk memberikan kemudahan bagi Anda.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center transform hover:-translate-y-2 transition duration-300">
                        <div class="flex justify-center items-center mb-4 bg-blue-100 rounded-full h-16 w-16 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Proses Cepat</h3>
                        <p class="text-gray-600">Isi formulir dan unggah dokumen hanya dalam beberapa menit. Tidak perlu menunggu lama.</p>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center transform hover:-translate-y-2 transition duration-300">
                        <div class="flex justify-center items-center mb-4 bg-blue-100 rounded-full h-16 w-16 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Panduan Lengkap</h3>
                        <p class="text-gray-600">Setiap langkah pendaftaran dilengkapi dengan panduan yang jelas dan mudah diikuti.</p>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center transform hover:-translate-y-2 transition duration-300">
                        <div class="flex justify-center items-center mb-4 bg-blue-100 rounded-full h-16 w-16 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Status Real-time</h3>
                        <p class="text-gray-600">Pantau status pendaftaran Anda kapan saja melalui dashboard personal Anda.</p>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} Informatika LPKIA. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>