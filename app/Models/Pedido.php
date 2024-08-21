<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = true;
    
    protected $fillable = [
        'id_cliente',
        'subtotal',
        'descuento',
        'iva',
        'total',
        'estado',
        'codigo_pedido',
    ];
    
    /**
    * Obtener los detalles del pedido.
    */
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
