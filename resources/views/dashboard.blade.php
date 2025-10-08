<x-app-layout>
    @php
    $pendaftaran = \App\Models\Pendaftaran::with(['programStudi'])
        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->first();
@endphp

    <div class="w-full h-[calc(100vh-64px)] flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 dark:from-gray-900 dark:to-gray-950">
        <div class="max-w-md w-full px-6 animate-fade-in">
            
            {{-- Card Status Pendaftaran --}}
            <div class="relative overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 shadow-2xl hover:scale-[1.02] transition-all duration-500">
                <div class="p-8 text-center">
                    <div class="flex justify-center">
                        <div class="p-3 bg-indigo-600/20 rounded-full mb-4">
                            <img src="{{ asset('images/form-icon.svg') }}" alt="Form" class="w-12 h-12">
                        </div>
                    </div>

                    @if($pendaftaran)
                        <h3 class="text-xl font-semibold text-green-400">Pendaftaran Ditemukan</h3>
                        <p class="mt-3 text-gray-300 leading-relaxed">
                            Anda sudah mendaftar pada program studi 
                            <span class="font-semibold text-white">
                                {{ $pendaftaran->programStudi->nama ?? '-' }}
                            </span>.
                        </p>
                        <a href="{{ route('mahasiswa.status') }}"
                            class="mt-6 inline-block px-6 py-3 rounded-lg bg-gradient-to-r from-green-500 to-green-700 text-white font-medium hover:shadow-lg hover:shadow-green-500/40 transition-all duration-300">
                            Lihat Status
                        </a>
                    @else
                        <h3 class="text-xl font-semibold text-white">Belum Ada Pendaftaran</h3>
                        <p class="mt-3 text-gray-300 leading-relaxed">
                            Lengkapi formulir untuk memulai proses pendaftaran Anda.
                        </p>
                        <a href="{{ route('pendaftaran.create') }}"
                            class="mt-6 inline-block px-6 py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-700 text-white font-medium hover:shadow-lg hover:shadow-indigo-500/40 transition-all duration-300">
                            Lengkapi Formulir
                        </a>
                    @endif
                </div>

                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent rounded-2xl pointer-events-none"></div>
            </div>
        </div>
    </div>

    {{-- Animasi Fade-in --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>
</x-app-layout>
