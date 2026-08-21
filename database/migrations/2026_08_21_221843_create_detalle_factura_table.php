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
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_producto");
            $table->unsignedBigInteger("id_factura");
            $table->integer("cantidad");
            $table->decimal("precio_unitario", 20, 2);
            $table->decimal("subtotal", 20, 2);
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('producto');
            $table->foreign('id_factura')->references('id')->on('factura');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_factura');
    }
};
