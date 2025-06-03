<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nisn',
        'tmpt_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'telp_rumah',
        'sekolah_asal',
        'tgl_masuk',
        'tgl_keluar',
        'status_pip',
        'admin_id',
        'tahun_ajaran_id',
        'kelas_id',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function tahunajaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function family(): HasOne
    {
        return $this->hasOne(SiswaFamily::class, 'siswa_id');
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
