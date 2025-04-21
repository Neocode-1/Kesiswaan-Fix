<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaFamily extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFamilyFactory> */
    use HasFactory;

    protected $table = 'siswa_families';


    protected $fillable = [
        'status_keluarga',
        'anak_ke',
        'nama_ayah',
        'nama_ibu',
        'alamat_ayah',
        'alamat_ibu',
        'no_telp_ayah',
        'no_telp_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'nama_wali',
        'alamat_wali',
        'no_telp_wali',
        'pekerjaan_wali',
        'siswa_id',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
