<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Status Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                <div class="p-8">

                    @if($pendaftaran)
                        {{-- Judul --}}
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Detail Pendaftaran Anda</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400 italic">
                                #{{ $pendaftaran->id }}
                            </span>
                        </div>

                        {{-- Isi Detail --}}
                        <div class="space-y-3 text-gray-700 dark:text-gray-300">
                            <p><strong>Program Studi:</strong> {{ $pendaftaran->programStudi->nama ?? '-' }}</p>
                            <p><strong>Mata Kuliah:</strong> {{ $pendaftaran->matakuliah->nama ?? '-' }}</p>
                            <p><strong>Jadwal:</strong> 
                                {{ $pendaftaran->jadwal->hari ?? '-' }} - {{ $pendaftaran->jadwal->jam ?? '-' }}
                            </p>
                            <p><strong>Alamat:</strong> {{ $pendaftaran->alamat ?? '-' }}</p>

                            <p>
                                <strong>Status:</strong> 
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($pendaftaran->status === 'pending') bg-yellow-100 text-yellow-800 
                                    @elseif($pendaftaran->status === 'diterima') bg-green-100 text-green-800 
                                    @elseif($pendaftaran->status === 'ditolak') bg-red-100 text-red-800 
                                    @else bg-gray-200 text-gray-700 
                                    @endif">
                                    {{ ucfirst($pendaftaran->status) }}
                                </span>
                            </p>

                            @if($pendaftaran->catatan_admin)
                                <div class="mt-4 bg-gray-50 dark:bg-gray-900/40 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <strong>Catatan:</strong>
                                    <p class="mt-2 text-sm leading-relaxed">{{ $pendaftaran->catatan_admin }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 flex items-center justify-between">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-5 py-2.5 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-800 focus:ring-2 focus:ring-gray-500 focus:outline-none transition-all">
                                ← Kembali ke Dashboard
                            </a>

                            
                        </div>
                    @else
                        {{-- Jika belum daftar --}}
                        <div class="text-center py-10">
                            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200">Belum Ada Pendaftaran</h3>
                            <p class="mt-3 text-gray-500 dark:text-gray-400">
                                Lengkapi formulir untuk memulai proses pendaftaran Anda.
                            </p>
                            <a href="{{ route('pendaftaran.create') }}" 
                               class="mt-6 inline-block px-6 py-3 rounded-lg bg-indigo-600 text-white font-medium hover:shadow-lg hover:shadow-indigo-500/40 transition-all duration-300">
                                Lengkapi Formulir
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
