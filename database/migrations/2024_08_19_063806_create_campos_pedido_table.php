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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->decimal('subtotal', 10, 2)->after('id_cliente')->default(0);
            $table->decimal('descuento', 10, 2)->after('subtotal')->default(0);
            $table->decimal('iva', 10, 2)->after('descuento')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['subtotal', 'descuento', 'iva', 'total']);
        });
    }
};
