<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'table_jurusan';

    protected $fillable = [
        'Kode_Jurusan',
        'Nama_Jurusan'
    ];
}