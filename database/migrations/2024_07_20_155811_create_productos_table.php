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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre_producto');
            $table->unsignedBigInteger('id_categoria'); 
            $table->longText('descripcion');
            $table->string('ruta_imagen');
            $table->string('marca');
            $table->timestamps();
            
            // Relación con la tabla categorias
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('restrict');
            
        });
    }
    
    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
