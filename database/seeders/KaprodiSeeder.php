<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaprodiSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'kaprodi@gmail.com'],
            [
                'name' => 'Kaprodi',
                'role' => 'kaprodi',
                'password' => Hash::make('password'),
            ]
        );
    }
}
