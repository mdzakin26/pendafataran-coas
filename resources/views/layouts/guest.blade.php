<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        
        <div class="w-full sm:max-w-4xl mt-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg grid grid-cols-1 lg:grid-cols-2">
            <div class="hidden lg:block bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop');">
                <div class="p-8 bg-blue-900 bg-opacity-50 h-full flex flex-col justify-between">
                    <div>
                        <a href="/" class="flex items-center space-x-2">
                          
                            
                        </a>
                    </div>
                    
                </div>
            </div>

            <div class="p-6 sm:p-8">
                {{-- Logo untuk tampilan mobile --}}
                <div class="lg:hidden flex justify-center mb-4">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>
                {{-- Di sinilah form login atau register akan ditampilkan --}}
                {{ $slot }}
            </div>
        </div>

    </div>
</body>

</html>