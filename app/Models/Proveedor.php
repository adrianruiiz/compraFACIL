<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_proveedor',
        'correo_proveedor',
        'telefono_proveedor',
        'contacto_fiscal',
        'direccion',
    ];
    
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'productos_proveedores', 'id_proveedor', 'id_producto')
        ->withPivot('precio', 'stock');
    }
}
