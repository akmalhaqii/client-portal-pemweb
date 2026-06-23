<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTestingRole extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@testing.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Contoh akun client
        $clientUser = User::create([
            'name'     => 'Klien',
            'email'    => 'client@testing.com',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        Client::create([
            'user_id' => $clientUser->id,
            'name'    => 'Klien',
            'company' => 'PT KLIEN',
            'phone'   => '081234567890',
            'address' => 'Malang, Jawa Timur',
        ]);
    }
}
