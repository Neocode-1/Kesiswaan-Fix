<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class);
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function ijazahs(): HasMany
    {
        return $this->hasMany(Ijazah::class);
    }

    public function prestasis(): HasMany
    {
        return $this->hasMany(Prestasi::class);
    }

    public function angkatan(): BelongsTo
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function kelas(): BelongsToMany
    {
        return $this->belongsToMany(Kelas::class);
    }
    public function klasifikasi(): BelongsTo
    {
        return $this->belongsTo(Klasifikasi::class);
    }
}
