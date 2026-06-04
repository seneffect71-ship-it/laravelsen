<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
    'nama',
    'nim',
    'nisn',
    'tempat_lahir',
    'tanggal_lahir',
    'alamat'
];
}