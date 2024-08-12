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
        Schema::create('tbl_pengguna', function (Blueprint $table) {
            $table->id('pengguna_id');
            $table->string('pengguna_name');
            $table->string('pengguna_email')->unique();
            $table->enum('pengguna_peran', ['Admin', 'User', 'Produk Owner'])->default('user'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengguna');
    }
};
