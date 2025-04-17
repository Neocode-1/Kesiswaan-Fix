<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Raport extends Model
{
    /** @use HasFactory<\Database\Factories\RaportFactory> */
    use HasFactory;

    protected $table = 'raports';

    protected $fillable = [
        'user_id',
        'upload_file',
        'catatan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
