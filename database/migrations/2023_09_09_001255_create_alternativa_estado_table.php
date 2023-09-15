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
        Schema::create('alternativa_estado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_alternativa');
            $table->unsignedBigInteger('id_problema');
            $table->integer('valor')->nullable();
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('id_estado')->references('id')->on('estado');
            $table->foreign('id_alternativa')->references('id')->on('alternativa');
            $table->foreign('id_problema')->references('id')->on('problema');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternativa_estado');
    }
};
