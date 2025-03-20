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
        Schema::create('social_media', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('profil_id'); 
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
            $table->string('title')->require();
            $table->string('url')->nullable();
            $table->text('svg')->require();
            $table->boolean('hide')->require();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
