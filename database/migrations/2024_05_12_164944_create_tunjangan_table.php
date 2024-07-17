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
        Schema::create('tunjangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('id_gaji')->nullable();
            $table->string('nama_tunjangan');
            $table->decimal('nominal', 10, 2);
            // Menambahkan foreign key untuk id_karyawan
            $table->foreign('id_karyawan')->references('id')->on('karyawan')->onDelete('cascade');
            // Menambahkan foreign key untuk id_gaji
            $table->foreign('id_gaji')->references('id')->on('gaji')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunjangan');
    }
};
