<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Ijazah;
use App\Models\Raport;
use App\Models\Absensi;
use App\Models\Prestasi;
use App\Models\Klasifikasi;
use App\Models\SiswaFamily;
use App\Models\Siswa_family;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Salman',
            'email' => 'salman16@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('123')
        ]);
        $dataUser = User::factory(50)->create();
        $dataKlasifikasi = Klasifikasi::factory(50)->create();
        $dataSiswa = Siswa::factory(50)->create();
        $dataFamily = SiswaFamily::factory(50)->create();
        $dataRaport = Raport::factory(50)->create();
        $dataIjazah = Ijazah::factory(50)->create();
        $dataAbsensi = Absensi::factory(50)->create();
        $dataKelas = Kelas::factory(50)->create();
        $dataPrestasi = Prestasi::factory(50)->create();

        foreach ($dataKlasifikasi as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
            ]);
        }

        foreach ($dataSiswa as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'klasifikasi_id' => Klasifikasi::all()->random()->id,
            ]);
        }

        foreach ($dataFamily as $data) {
            $data->update([
                'siswa_id' => Siswa::all()->random()->id,
            ]);
        }

        foreach ($dataRaport as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'klasifikasi_id' => Klasifikasi::all()->random()->id,
                'siswa_id' => Siswa::all()->random()->id,
            ]);
        }

        foreach ($dataIjazah as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'klasifikasi_id' => Klasifikasi::all()->random()->id,
                'siswa_id' => Siswa::all()->random()->id,
            ]);
        }
        foreach ($dataAbsensi as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'klasifikasi_id' => Klasifikasi::all()->random()->id,
            ]);
        }

        foreach ($dataKelas as $data) {
            $data->update([
                'absensi_id' => Absensi::all()->random()->id,
            ]);
        }
        foreach ($dataPrestasi as $data) {
            $data->update([
                'siswa_id' => Siswa::all()->random()->id,
            ]);
        }
    }
}
