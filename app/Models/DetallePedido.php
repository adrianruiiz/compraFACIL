<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalles_pedidos';
    protected $primaryKey = 'id_detalle_pedido';
    public $timestamps = true;

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'id_proveedor',
        'cantidad',
        'precio',
    ];

    /**
     * Obtener el pedido asociado.
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }

    /**
     * Obtener el producto asociado.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * Obtener el proveedor asociado.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
