<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klasifikasi extends Model
{
    /** @use HasFactory<\Database\Factories\KlarifikasiFactory> */
    use HasFactory;

    protected $table = 'klasifikasis';

    protected $fillable = [
        'tahun_masuk'
    ];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
