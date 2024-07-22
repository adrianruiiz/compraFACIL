<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $primaryKey = 'id_departamento';
    protected $fillable = ['nombre_departamento'];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'departamentos_categorias', 'id_departamento', 'id_categoria');
    }
}
