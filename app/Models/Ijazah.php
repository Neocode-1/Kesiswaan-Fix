<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ijazah extends Model
{
    /** @use HasFactory<\Database\Factories\IjazahFactory> */
    use HasFactory;

    protected $table = 'ijazahs';

    protected $fillable = [
        'admin_id',
        'tahun_ajaran_id',
        'siswa_id',
        'upload_file',
        'tahun_lulus',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function tahunajaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
