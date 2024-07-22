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
        Schema::create('departamentos_categorias', function (Blueprint $table) {
            $table->id('id_departamento_cat');
            $table->unsignedBigInteger('id_departamento');
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();
            
            // Relación con la tabla departamentos
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos')->onDelete('restrict');
            // Relación con la tabla categorias
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('restrict');        
    });
}

/**
* Reverse the migrations.
*/
public function down(): void
{
    Schema::dropIfExists('departamentos_categorias');
}
};
