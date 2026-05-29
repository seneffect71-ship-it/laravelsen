<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {

            $table->id();

            $table->string('kode_kelas');

            $table->unsignedBigInteger('kode_mata_kuliah');
            $table->unsignedBigInteger('kode_dosen');

            $table->enum('hari', [
                'senin',
                'selasa',
                'rabu',
                'kamis',
                'jumat'
            ]);

            $table->enum('jam', [
                '08:00 - 09:40',
                '09:50 - 11:30',
                '12:30 - 14:10',
                '17:00 - 18:40',
                '19:00 - 20:40'
            ]);

            $table->string('tahun_ajaran');

            $table->string('ruang_kelas');

            $table->integer('jumlah_max');

            $table->integer('jumlah_mahasiswa')
                  ->default(0);

            $table->enum('semester', [
                'ganjil',
                'genap'
            ]);

            $table->timestamps();

            $table->unique([
                'kode_dosen',
                'hari',
                'jam',
                'tahun_ajaran',
                'semester'
            ]);

            $table->unique([
                'ruang_kelas',
                'hari',
                'jam',
                'tahun_ajaran',
                'semester'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};