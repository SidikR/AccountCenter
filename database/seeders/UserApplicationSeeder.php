<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserApplication;
use Illuminate\Support\Str;

class UserApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        UserApplication::create([
            'email' => 'andreagung777@gmail.com',
            'role_user' => 'admin',
            'id_applications' => 1
        ]);

        UserApplication::create([
            'email' => 'budi@gmail.com',
            'role_user' => 'admin',
            'id_applications' => 1
        ]);

        UserApplication::create([
            'email' => 'andreagung777@gmail.com',
            'role_user' => 'admin',
            'id_applications' => 2
        ]);
        // UserApplication::factory(10)->create();
    }
}
