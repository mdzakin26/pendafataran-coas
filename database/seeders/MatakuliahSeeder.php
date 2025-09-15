<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Matakuliah::create(['kode' => 'IF101', 'nama' => 'Algoritma', 'sks' => 3, 'semester' => '1']);
    Matakuliah::create(['kode' => 'IF102', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => '2']);
    }
}
