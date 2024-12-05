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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('package', ['Essential', 'Basic', 'Premium', 'Pro', 'Ultimate'])->nullable();
            $table->date('subscripition_start_at')->nullable();
            $table->date('subscripition_end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('subscripition_end_at', 'subscripition_start_at', 'packege');
        });
    }
};
