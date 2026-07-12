<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrsDetail extends Model
{
    protected $table = 'krs_detail';

    protected $fillable = [
        'kode_krs',
        'kode_kelas',
        'status'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kode_kelas', 'id');
    }

    public function krs()
    {
        return $this->belongsTo(Krs::class, 'kode_krs', 'id');
    }
}