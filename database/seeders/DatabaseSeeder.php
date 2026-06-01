<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Rollen aanmaken
        $adminRole  = Role::firstOrCreate(['name' => 'admin']);
        $melderRole = Role::firstOrCreate(['name' => 'melder']);

        // Admin gebruiker aanmaken
        $admin = User::firstOrCreate(
            ['email' => 'admin@ufomeldpunt.nl'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );
        $admin->syncRoles($adminRole);

        // Test melder aanmaken
        $melder = User::firstOrCreate(
            ['email' => 'melder@ufomeldpunt.nl'],
            [
                'name'     => 'Jan de Melder',
                'password' => Hash::make('password'),
                'role'     => 'reporter',
            ]
        );
        $melder->syncRoles($melderRole);

        // Bestaande gebruikers zonder Spatie-rol toewijzen op basis van role-kolom
        User::all()->each(function (User $user) use ($adminRole, $melderRole) {
            if ($user->getRoleNames()->isEmpty()) {
                $user->assignRole($user->role === 'admin' ? $adminRole : $melderRole);
            }
        });
    }
}

