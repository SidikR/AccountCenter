<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TblApplications;
use Illuminate\Support\Str;

class TblApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TblApplications::create([
            'kode_aplikasi' => 'SI001',
            'nama_aplikasi' => 'Mata Elang Pembangunan'
        ]);

        TblApplications::create([
            'kode_aplikasi' => 'SI002',
            'nama_aplikasi' => 'ACCOUNT CENTER'
        ]);
        // TblApplications::factory(10)->create();
    }
}
