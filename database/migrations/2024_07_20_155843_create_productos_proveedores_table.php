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
        Schema::create('productos_proveedores', function (Blueprint $table) {
            $table->id('id_producto_proveedor');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_proveedor');
            $table->decimal('precio', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();

            // Relación con la tabla productos
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('restrict');
            // Relación con la tabla proveedores
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_proveedores');
    }
};
