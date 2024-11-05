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
        Schema::create('checklists', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('backlog_id');  
            $table->text('description')->nullable(); 
            $table->enum('status', ['0', '1'])->default('0');
            $table->timestamps(); 

            $table->foreign('backlog_id')->references('id')->on('backlogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
