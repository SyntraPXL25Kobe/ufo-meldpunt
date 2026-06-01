<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin gebruiker aanmaken
        User::firstOrCreate(
            ['email' => 'admin@ufomeldpunt.nl'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Test melder aanmaken
        User::firstOrCreate(
            ['email' => 'melder@ufomeldpunt.nl'],
            [
                'name'     => 'Jan de Melder',
                'password' => Hash::make('password'),
                'role'     => 'reporter',
            ]
        );
    }
}
