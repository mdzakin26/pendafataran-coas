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
        return Pendaftaran::with(['user', 'programStudi', 'matakuliah'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Program Studi',
            'Mata Kuliah',
            'jadwal',
            'Status',
            'Tanggal Daftar'
        ];
    }

    public function map($p): array
{
    return [
        $p->user->name ?? '-',
        $p->user->email ?? '-',
        $p->programStudi->nama_prodi ?? '-',
        $p->matakuliah->nama ?? '-',
        $p->status ?? '-',
        $p->created_at->format('d-m-Y'),
    ];
}

}
