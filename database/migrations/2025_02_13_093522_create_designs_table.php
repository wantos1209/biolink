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
        Schema::create('designs', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('profil_id'); 
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
            $table->string('font')->nullable();
            $table->string('font_color')->nullable();
            $table->string('border_button')->nullable();
            $table->string('background_button')->nullable();
            $table->string('bordir_button')->nullable();
            $table->string('color_button')->nullable();
            $table->string('background_page')->nullable();
            $table->string('theme')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
