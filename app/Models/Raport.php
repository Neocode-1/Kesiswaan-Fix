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
        'admin_id',
        'klasifikasi_id',
        'siswa_id',
        'upload_file',
        'catatan',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function klasifikasi(): BelongsTo
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
