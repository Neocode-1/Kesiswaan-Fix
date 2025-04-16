<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nisn',
        'ttl',
        'jenis_kelamin',
        'agama',
        'sklh_asal',
        'tgl_masuk',
        'tgl_keluar',
        'status_klrga',
        'anak_ke',
        'alamat',
        'telp_rumah',
        'status_pip',
        'nama_ortu',
        'alamat_ortu',
        'no_telp',
        'pekerjaan',
        'nama_wali',
        'alamat_wali',
        'pekerjaan_wali',
    ];
}
