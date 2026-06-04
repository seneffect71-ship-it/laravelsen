<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_mahasiswa');
            $table->string('tahun_ajaran');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('status', ['pending', 'approved', 'partial', 'declined']);
            $table->integer('total_sks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('krs');
    }
}
