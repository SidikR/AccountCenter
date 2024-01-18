<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Database\Seeders\UserDetailsSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\UserApplicationSeeder;
use Database\Seeders\TblApplicationsSeeder;
use Database\Seeders\TblLoginSeeder;
use Database\Seeders\OpdSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersSeeder::class,
            UserDetailsSeeder::class,
            UserApplicationSeeder::class,
            TblApplicationsSeeder::class,
            TblLoginSeeder::class,
            OpdSeeder::class
        ]);
    }
}
