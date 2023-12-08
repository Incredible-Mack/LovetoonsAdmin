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
        Schema::create('let_read_the_bible_video', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('biblechapter');
            $table->string('image');
            $table->string('link');
            $table->date('reg_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('let_read_the_bible_video');
    }
};
