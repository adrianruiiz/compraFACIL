<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre_categoria', 'descripcion'];

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'departamentos_categorias', 'id_categoria', 'id_departamento');
    }
}
