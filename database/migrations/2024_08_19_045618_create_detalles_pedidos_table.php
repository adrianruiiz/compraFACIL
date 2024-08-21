<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    */
    public function up()
    {
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->id('id_detalle_pedido');
            $table->unsignedBigInteger('id_pedido'); // Relación con la tabla pedidos
            $table->unsignedBigInteger('id_producto'); // Relación con la tabla productos
            $table->unsignedBigInteger('id_proveedor'); // Relación con la tabla proveedores
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2); // Precio del producto
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores');
        });
    }   
    
    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedidos');
    }
};
