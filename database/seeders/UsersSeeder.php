<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'andreagung777@gmail.com',
            'password' => Hash::make('123'),
            'status_akun' => 'aktif'
        ]);

        User::create([
            'email' => 'budi@gmail.com',
            'password' => Hash::make('123'),
            'status_akun' => 'aktif'
        ]);

        User::create([
            'email' => 'budi2@gmail.com',
            'password' => Hash::make('123'),
            'status_akun' => 'aktif'
        ]);

        User::create([
            'email' => 'budi3@gmail.com',
            'password' => Hash::make('123'),
            'status_akun' => 'aktif'
        ]);

        User::create([
            'email' => 'budi4@gmail.com',
            'password' => Hash::make('123'),
            'status_akun' => 'aktif'
        ]);

        User::create([
            'email' => 'budi5@gmail.com',
            'password' => Hash::make('123'),
            'status_akun' => 'aktif'
        ]);

        // User::factory(10)->create();
    }
}
