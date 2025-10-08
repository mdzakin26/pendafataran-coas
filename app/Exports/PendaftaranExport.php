<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftaranExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pendaftaran::with('user', 'programStudi', 'matakuliah')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Email',
            'Nomor Telepon',
            'Program Studi',
            'Mata Kuliah Pilihan',
            'Status',
            'Tanggal Daftar'
        ];
    }

    public function map($pendaftaran): array
    {
        return [
            $pendaftaran->user->name ?? '-',
            $pendaftaran->user->email ?? '-',
            $pendaftaran->no_telepon ?? '-',
            $pendaftaran->programStudi->nama ?? '-',
            $pendaftaran->matakuliah->nama ?? '-',
            ucfirst($pendaftaran->status ?? '-'),
            $pendaftaran->created_at->format('d-m-Y'),
        ];
    }
}
