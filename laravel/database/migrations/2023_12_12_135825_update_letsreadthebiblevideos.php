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
        Schema::table('let_read_the_bible_video', function (Blueprint $table) {
            $table->string('status')->default('active');
            // Add more changes as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('let_read_the_bible_video', function (Blueprint $table) {
            $table->dropColumn('status');
            // Add more changes as needed
        });
    }
};
