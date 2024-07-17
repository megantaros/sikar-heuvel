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
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('hutang_id')
                ->constrained('hutang')
                ->onDelete('cascade');
            $table->decimal('angsuran_pertama', 15, 2)->nullable();
            $table->decimal('angsuran_kedua', 15, 2)->nullable();
            $table->decimal('angsuran_ketiga', 15, 2)->nullable();
            $table->decimal('angsuran_keempat', 15, 2)->nullable();
            $table->date('tanggal_angsuran_pertama')->nullable();
            $table->date('tanggal_angsuran_kedua')->nullable();
            $table->date('tanggal_angsuran_ketiga')->nullable();
            $table->date('tanggal_angsuran_keempat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};
