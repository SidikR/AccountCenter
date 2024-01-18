<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TblLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TblLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TblLogin::create([
            'email' => 'andreagung1111@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'status_akun' => 'aktif'
        ]);

        TblLogin::create([
            'email' => 'lala@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'status_akun' => 'aktif'
        ]);

        TblLogin::create([
            'email' => 'lele@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'status_akun' => 'aktif'
        ]);
    }
}
