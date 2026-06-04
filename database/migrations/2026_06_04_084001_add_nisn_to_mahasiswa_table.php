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
        if (! Schema::hasColumn('mahasiswa', 'nisn')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->string('nisn')->nullable()->unique()->after('nim');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('mahasiswa', 'nisn')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->dropColumn('nisn');
            });
        }
    }
};
