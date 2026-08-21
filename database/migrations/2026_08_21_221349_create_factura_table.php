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
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->unsignedBigInteger('id_cliente');
            $table->enum("estado", ["carrito", "pendiente", "pagado", "anulada"]);
            $table->string('observaciones')->nullable();
            $table->enum('metodo_pago', ["tarjeta", "transferencia", "efectivo"]);
            $table->decimal("total", 10, 2);
            $table->timestamps();

            $table->foreign("id_cliente")->references("id")->on("cliente");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
