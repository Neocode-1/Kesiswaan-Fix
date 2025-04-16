<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
