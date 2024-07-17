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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->unsignedBigInteger('id_hutang')->nullable();
            $table->unsignedBigInteger('id_kehadiran')->nullable();
            $table->decimal('gaji', 10, 2);
            // Menambahkan foreign key id_karyawan
            $table->foreign('id_karyawan')->references('id')->on('karyawan')->onDelete('cascade');
            // Menambahkan foreign key id_hutang
            $table->foreign('id_hutang')->references('id')->on('hutang')->onDelete('set null');
            // Menambahkan foreign key id_kehadiran
            $table->foreign('id_kehadiran')->references('id')->on('kehadiran')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
