<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoCategoria extends Model
{
    use HasFactory;
    
    protected $table = 'departamentos_categorias'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_departamento_cat'; // Clave primaria
    
    
    protected $fillable = ['id_departamento', 'id_categoria']; 
    
    // Relación inversa con Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento', 'id_departamento');
    }
    
    // Relación inversa con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
    

    
}
