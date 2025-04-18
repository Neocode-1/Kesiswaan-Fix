<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    /** @use HasFactory<\Database\Factories\AngkatanFactory> */
    use HasFactory;

    protected $table = 'angkatans';

    protected $fillable = [
        'tahun',
    ];
}
