<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'kode_mahasiswa',
        'tahun_ajaran',
        'semester',
        'status',
        'total_sks'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'kode_mahasiswa', 'id');
    }

    public function details()
    {
        return $this->hasMany(KrsDetail::class, 'kode_krs', 'id');
    }
}