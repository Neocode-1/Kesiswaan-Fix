<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Angkatan;
use App\Models\Ijazah;
use App\Models\Kelas;
use App\Models\Klarifikasi;
use App\Models\Prestasi;
use App\Models\Raport;
use App\Models\Siswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Siswa::factory(50)->create();
        Angkatan::factory(50)->create();
        Raport::factory(50)->create();
        Ijazah::factory(50)->create();
        Kelas::factory(50)->create();
        Absensi::factory(50)->create();
        Prestasi::factory(50)->create();
        Klarifikasi::factory(50)->create();
    }
}
