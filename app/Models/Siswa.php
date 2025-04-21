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
        'alamat',
        'telp_rumah',
        'sekolah_asal',
        'tgl_masuk',
        'tgl_keluar',
        'status_pip',
        'admin_id',
        'klasifikasi_id',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function klasifikasi(): BelongsTo
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id');
    }

    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class, 'siswa_id');
    }

    public function ijazahs(): HasMany
    {
        return $this->hasMany(Ijazah::class, 'siswa_id');
    }

    public function prestasis(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'siswa_id');
    }
}
