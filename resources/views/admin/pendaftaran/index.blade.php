{{-- resources/views/admin/pendaftaran/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen Pendaftar')

@section('content')
    {{-- <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Pendaftar') }}
            </h2> --}}
        {{-- </div>
    </header> --}} 

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4">
                            <form action="{{ route('admin.pendaftaran.index') }}" method="GET"
                                  class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-grow">
                                    <input type="text" name="search" placeholder="Cari nama atau email..."
                                           value="{{ $search ?? '' }}"
                                           class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                                  focus:border-indigo-500 dark:focus:border-indigo-600
                                                  focus:ring-indigo-500 dark:focus:ring-indigo-600
                                                  rounded-md shadow-sm">
                                </div>
                                <div>
                                    <select name="status"
                                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                                   focus:border-indigo-500 dark:focus:border-indigo-600
                                                   focus:ring-indigo-500 dark:focus:ring-indigo-600
                                                   rounded-md shadow-sm">
                                        <option value="">Semua Status</option>
                                        <option value="pending" @if(isset($status) && $status=='pending') selected @endif>Pending</option>
                                        <option value="diverifikasi" @if(isset($status) && $status=='diverifikasi') selected @endif>Diverifikasi</option>
                                        <option value="ditolak" @if(isset($status) && $status=='ditolak') selected @endif>Ditolak</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit"
                                            class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                                        Filter
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- tabel pendaftar --}}
                        @include('admin.pendaftaran.partials.pendaftar-table')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
