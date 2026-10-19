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
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre', 100);
            $table->string('descripcion', 191)->nullable();
            $table->string('tipo', 30);
            $table->string('estado', 30)->default('activa');
            $table->decimal('capacidad', 12, 2)->nullable();
            $table->string('unidad_capacidad', 30)->nullable();
            $table->unsignedBigInteger('id_ubicacion_padre')->nullable();
            $table->timestamps();

            $table->foreign('id_ubicacion_padre')->references('id')->on('ubicacion')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion');
    }
};
