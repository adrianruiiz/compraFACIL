<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoProveedor extends Model
{
    use HasFactory;
    
    protected $table = 'productos_proveedores';
    protected $primaryKey = 'id_producto_proveedor';
    public $timestamps = false;
    
    protected $fillable = [
        'id_producto',
        'id_proveedor',
        'precio',
        'stock',
    ];
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
    
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
