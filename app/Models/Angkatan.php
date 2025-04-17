<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Angkatan extends Model
{
    /** @use HasFactory<\Database\Factories\AngkatanFactory> */
    use HasFactory;

    protected $table = 'angkatans';

    protected $fillable = [
        'tahun',
    ];


    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class);
    }
}
