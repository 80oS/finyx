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
        Schema::create('producto_ubicacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_ubicacion');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('producto');
            $table->foreign('id_ubicacion')->references('id')->on('ubicacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_ubicacion');
    }
};
