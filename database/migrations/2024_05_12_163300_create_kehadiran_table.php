<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->time('jam_hadir')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->date('tanggal');
            $table->integer('tepat_waktu')->nullable();
            $table->integer('telat')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('denda')->nullable();
            $table->string('status_kehadiran')->nullable();
            // Menambahkan foreign key karyawan_id
            $table
                ->foreign('id_karyawan')
                ->references('id')
                ->on('karyawan')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
