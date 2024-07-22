<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_producto',
        'id_categoria',
        'descripcion',
        'ruta_imagen',
    ];
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
    
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'productos_proveedores', 'id_producto', 'id_proveedor')
        ->withPivot('precio', 'stock');
    }
    
}
