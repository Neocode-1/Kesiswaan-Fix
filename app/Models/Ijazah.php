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
        'upload_file',
        'tahun_lulus',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
