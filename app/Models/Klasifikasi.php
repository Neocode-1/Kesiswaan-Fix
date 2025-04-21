<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klasifikasi extends Model
{
    /** @use HasFactory<\Database\Factories\KlarifikasiFactory> */
    use HasFactory;

    protected $table = 'klasifikasis';

    protected $fillable = [
        'tahun_masuk',
        'admin_id'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'klasifikasi_id');
    }

    public function rsports(): HasMany
    {
        return $this->hasMany(Raport::class, 'klasifikasi_id');
    }

    public function ijazahs(): HasMany
    {
        return $this->hasMany(Ijazah::class, 'klasifikasi_id');
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'klasifikasi_id');
    }
}
