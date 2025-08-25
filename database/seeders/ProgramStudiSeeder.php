<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStudi::create(['nama_prodi' => 'Teknik Informatika', 'fakultas' => 'Ilmu Komputer', 'biaya_pendaftaran' => 2500000]);
        ProgramStudi::create(['nama_prodi' => 'Sistem Informasi', 'fakultas' => 'Ilmu Komputer', 'biaya_pendaftaran' => 2500000]);
        ProgramStudi::create(['nama_prodi' => 'Manajemen', 'fakultas' => 'Ekonomi', 'biaya_pendaftaran' => 2500000]);
        ProgramStudi::create(['nama_prodi' => 'Akuntansi', 'fakultas' => 'Ekonomi', 'biaya_pendaftaran' => 2000000]);
    }
}
