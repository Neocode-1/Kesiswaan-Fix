<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    /** @use HasFactory<\Database\Factories\KlarifikasiFactory> */
    use HasFactory;

    protected $table = 'tahun_ajarans';

    protected $fillable = [
        'tahun_ajaran',
        'admin_id'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'tahun_ajaran_id');
    }

    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class, 'tahun_ajaran_id');
    }

    public function ijazahs(): HasMany
    {
        return $this->hasMany(Ijazah::class, 'tahun_ajaran_id');
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'tahun_ajaran_id');
    }
}
