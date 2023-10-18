<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'jenis_kelamin',
        'status',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat',
    ];
}
