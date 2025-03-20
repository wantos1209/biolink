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
        Schema::create('headers', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('profil_id'); 
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
            $table->string('position')->require();
            $table->string('title')->require();
            $table->boolean('hide')->require();
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
