<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;
    
    protected $fillable = [
        'id_cliente',
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];
    
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }
}
