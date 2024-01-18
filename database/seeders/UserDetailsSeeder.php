<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserDetails;
use Illuminate\Support\Str;

class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        UserDetails::create([
            'email' => 'andreagung777@gmail.com',
            'nama_lengkap' => 'Andre Agung',
            'no_hp' => '081379886085',
            'nip' => '182911916782378182',
            'foto_user' => null,
            'id_opds' => 1
        ]);

        UserDetails::create([
            'email' => 'budi@gmail.com',
            'nama_lengkap' => 'Budianto',
            'no_hp' => '0812121212',
            'nip' => '182911916782371111',
            'foto_user' => null,
            'id_opds' => 2
        ]);
        UserDetails::create([
            'email' => 'budi2@gmail.com',
            'nama_lengkap' => 'Budianto2',
            'no_hp' => '0812121212',
            'nip' => '182911916782371111',
            'foto_user' => null,
            'id_opds' => 2
        ]);
        UserDetails::create([
            'email' => 'budi3@gmail.com',
            'nama_lengkap' => 'Budianto3',
            'no_hp' => '0812121212',
            'nip' => '182911916782371111',
            'foto_user' => null,
            'id_opds' => 2
        ]);
        UserDetails::create([
            'email' => 'budi4@gmail.com',
            'nama_lengkap' => 'Budianto4',
            'no_hp' => '0812121212',
            'nip' => '182911916782371111',
            'foto_user' => null,
            'id_opds' => 2
        ]);
        UserDetails::create([
            'email' => 'budi5@gmail.com',
            'nama_lengkap' => 'Budianto5',
            'no_hp' => '0812121212',
            'nip' => '182911916782371111',
            'foto_user' => null,
            'id_opds' => 2
        ]);


        // UserDetails::factory(10)->create();
    }
}
