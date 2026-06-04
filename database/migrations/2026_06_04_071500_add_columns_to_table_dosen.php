<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('table_dosen', function (Blueprint $table) {
            if (! Schema::hasColumn('table_dosen', 'Fullname')) {
                $table->string('Fullname')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'NIP')) {
                $table->string('NIP')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'NIDN')) {
                $table->string('NIDN')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'Pendidikan_Terakhir')) {
                $table->string('Pendidikan_Terakhir')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'Jurusan_id')) {
                $table->string('Jurusan_id')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'Tempat_Lahir')) {
                $table->string('Tempat_Lahir')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'Tanggal_Lahir')) {
                $table->date('Tanggal_Lahir')->nullable();
            }
            if (! Schema::hasColumn('table_dosen', 'Alamat')) {
                $table->text('Alamat')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('table_dosen', function (Blueprint $table) {
            $drop = [];
            foreach ([
                'Fullname', 'NIP', 'NIDN', 'Pendidikan_Terakhir', 'Jurusan_id', 'Tempat_Lahir', 'Tanggal_Lahir', 'Alamat'
            ] as $column) {
                if (Schema::hasColumn('table_dosen', $column)) {
                    $drop[] = $column;
                }
            }
            if (! empty($drop)) {
                $table->dropColumn($drop);
            }
        });
    }
};
