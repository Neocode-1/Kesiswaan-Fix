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
use App\Models\TahunAjaran;
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
        $dataTahun = TahunAjaran::factory(50)->create();
        $dataSiswa = Siswa::factory(500)->create();
        $dataFamily = SiswaFamily::factory(500)->create();
        $dataRaport = Raport::factory(500)->create();
        $dataIjazah = Ijazah::factory(500)->create();
        $dataAbsensi = Absensi::factory(50)->create();
        $dataKelas = Kelas::factory(72)->create();
        $dataPrestasi = Prestasi::factory(50)->create();

        foreach ($dataTahun as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
            ]);
        }

        foreach ($dataSiswa as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'tahun_ajaran_id' => TahunAjaran::all()->random()->id,
                'kelas_id' => Kelas::all()->random()->id,
            ]);
        }

        foreach ($dataFamily as $index => $family) {
            $siswa = $dataSiswa[$index]; // ambil siswa ke-n
            $family->update([
                'siswa_id' => $siswa->id,
            ]);
        }

        foreach ($dataRaport as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'tahun_ajaran_id' => TahunAjaran::all()->random()->id,
            ]);
        }
        foreach ($dataRaport as $index => $raport) {
            $siswa = $dataSiswa[$index]; // ambil siswa ke-n
            $raport->update([
                'siswa_id' => $siswa->id,
            ]);
        }
        foreach ($dataIjazah as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'tahun_ajaran_id' => TahunAjaran::all()->random()->id,
            ]);
        }
        foreach ($dataIjazah as $index => $ijazah) {
            $siswa = $dataSiswa[$index]; // ambil siswa ke-n
            $ijazah->update([
                'siswa_id' => $siswa->id,
            ]);
        }
        foreach ($dataAbsensi as $data) {
            $data->update([
                'admin_id' => User::all()->random()->id,
                'kelas_id' => Kelas::all()->random()->id,
                'tahun_ajaran_id' => TahunAjaran::all()->random()->id,
            ]);
        }

        foreach ($dataPrestasi as $data) {
            $data->update([
                'siswa_id' => Siswa::all()->random()->id,
            ]);
        }
        // foreach ($dataPrestasi as $index => $prestasi) {
        //     $siswa = $dataSiswa[$index]; // ambil siswa ke-n
        //     $prestasi->update([
        //         'siswa_id' => $siswa->id,
        //     ]);
        // }
    }
}
