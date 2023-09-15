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
        Schema::create('maximin', function (Blueprint $table) {
            $table->id();
            $table->integer('Seleccionada');
            $table->text('Observacion');
            $table->unsignedBigInteger('id_alternativa_estado')->nullable();
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('id_alternativa_estado')->references('id')->on('alternativa_estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maximin');
    }
};
