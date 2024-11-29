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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained()->on('instructors')->onDelete('cascade');
            $table->enum('order_status', ['bending', 'active', 'deleted', 'hit_sl', 'hit_tp1', 'hit_tp2', 'hit_tp3', 'hit_tp4', 'hit_tp5']);
            $table->string('pair');
            $table->decimal('price', 10, 2);
            $table->string('order_type'); // e.g., 'buy' or 'sell'  
            $table->decimal('sl', 10, 2)->nullable(); // Stop Loss  
            $table->decimal('tp1', 10, 2)->nullable(); // Take Profit 1  
            $table->decimal('tp2', 10, 2)->nullable();
            $table->decimal('tp3', 10, 2)->nullable();
            $table->decimal('tp4', 10, 2)->nullable();
            $table->decimal('tp5', 10, 2)->nullable();
            $table->string('chart')->nullable(); // URL or path to the chart image  
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
