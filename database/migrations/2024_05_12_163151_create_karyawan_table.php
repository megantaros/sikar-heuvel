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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('nama_karyawan');
            $table->string('jabatan');
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            // Menambahkan foreign key user
            $table
                ->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
