<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    /** @use HasFactory<\Database\Factories\IjazahFactory> */
    use HasFactory;

    protected $table = 'ijazahs';

    protected $fillable = [
        'upload_file',
        'tahun_lulus',
    ];
}
