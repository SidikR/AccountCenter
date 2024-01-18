<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Opd;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Opd::create([
            'nama_opds' => 'Dinas Kesehatan'
        ]);

        Opd::create([
            'nama_opds' => 'Dinas Pendidikan'
        ]);

        Opd::create([
            'nama_opds' => 'Dinas Sosial'
        ]);
    }
}
