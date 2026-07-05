<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'table_mata_kuliah';

    protected $fillable = [
        'Jurusan_Id',
        'Kode_Mata_Kuliah',
        'Nama_Mata_Kuliah',
        'SKS',
        'Dosen_Id'
    ];

    public function kelas() {
        return $this->hasMany(Kelas::class, 'id', 'kode_mata_kuliah');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'Dosen_Id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'Jurusan_Id');
    }
}
