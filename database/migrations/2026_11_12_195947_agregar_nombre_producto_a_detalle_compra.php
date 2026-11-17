<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detalle_compra', function (Blueprint $table) {
            $table->string('nombre_producto')->default('')->after('id_compra');
            $table->unsignedBigInteger('id_producto')->nullable()->change();
        });

        Schema::table('compra', function (Blueprint $table) {
            $table->decimal('iva', 20, 2)->default(0);
            $table->decimal('descuento', 20, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('compra', function (Blueprint $table) {
            $table->dropColumn(['iva', 'descuento']);
        });

        Schema::table('detalle_compra', function (Blueprint $table) {
            $table->dropColumn('nombre_producto');
        });
    }
};