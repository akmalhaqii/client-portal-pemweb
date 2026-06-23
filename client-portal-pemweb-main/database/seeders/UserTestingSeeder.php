<?php

namespace Database\Seeders;

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ADMIN
        User::create([
            'name' => 'Admin Test',
            'email' => 'admin@testing.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        //USER BIASA
        User::create([
            'name' => 'User Test',
            'email' => 'user@testing.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        //TAILOR
        User::create([
            'name' => 'Tailor Test',
            'email' => 'tailor@testing.com',
            'password' => Hash::make('password'),
            'role' => 'tailor',
        ]);
    }
}
