<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    /** @use HasFactory<\Database\Factories\PrestasiFactory> */
    use HasFactory;

    protected $table = 'prestasis';

    protected $fillable = [
        'nama',
        'nama_prestasi',
        'tingkat',
        'foto_up',
        'tahun',
    ];
}
