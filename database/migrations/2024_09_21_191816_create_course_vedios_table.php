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
            $table->string('video_url');
            $table->integer('duration'); // Assuming time is in seconds or minutes  
            $table->text('description');
            $table->string('image'); // Assuming this stores the path to the image  
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
