<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class KaprodiSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'kaprodi@pendaftaran.com'], // supaya tidak duplicate
            [
                'name' => 'Kaprodi',
                'password' => Hash::make('passwordkaprodi'),
                'role' => 'kaprodi',
            ]
        );
    }
}
