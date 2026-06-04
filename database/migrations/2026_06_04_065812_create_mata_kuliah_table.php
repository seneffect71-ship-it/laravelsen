<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->integer('Jurusan_Id');
            $table->string('Kode_Mata_Kuliah')->unique();
            $table->string('Nama_Mata_Kuliah');
            $table->integer('SKS');
            $table->integer('Dosen_Id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mata_kuliah');
    }
};