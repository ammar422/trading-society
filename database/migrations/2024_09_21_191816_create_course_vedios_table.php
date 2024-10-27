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
        Schema::create('course_vedios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->on('courses')->onDelete('cascade'); // Assuming a foreign key to courses  
            $table->string('vedio_url');
            $table->string('duration'); 
            $table->text('description');
            $table->string('image'); 
            $table->integer('order')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_vedios');
    }
};
