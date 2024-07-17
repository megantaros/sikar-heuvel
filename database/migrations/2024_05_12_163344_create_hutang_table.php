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
        Schema::create('hutang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            $table->decimal('total_hutang', 10, 2);
            $table->decimal('maksimal_hutang', 10, 2);
            $table->date('tanggal_hutang');
            $table->decimal('sisa_hutang', 10, 2)->nullable();
            // Menambahkan foreign key id_karyawan
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
        Schema::dropIfExists('hutang');
    }
};
