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
            Schema::create('backlogs', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->text('description')->nullable(); 
            $table->string('priority')->nullable(); 
            $table->integer('hours')->nullable(); 
            $table->enum('status', ['0', '1'])->default('0');
            $table->unsignedBigInteger('sprint_id')->nullable(); 
            $table->unsignedBigInteger('product_id')->nullable(); 
            $table->timestamps(); 

            $table->foreign('sprint_id')->references('id')->on('sprints')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlogs');
    }
};
