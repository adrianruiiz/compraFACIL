<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\DepartamentoCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('departamentos')->get(); //obtener todas las categorias con departamento
        $departamentos = Departamento::all(); //obtener todos los departamentos
        return view('admin.categorias.index', compact('categorias','departamentos'));
    }
    
    public function create()
    {
        $departamentos = Departamento::all();//obtener todos los departamentos
        return view('admin.categorias.create', compact('departamentos'));
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        //validar los datos recibidos
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        
        //insert en la tabla de Categorias
        $categoria = Categoria::create($request->only('nombre_categoria', 'descripcion'));
        
        if ($request['id_departamento']) {
            DepartamentoCategoria::create([
                'id_departamento' => $request->departamento_id,
                'id_categoria' => $categoria->id_categoria,
            ]);
        }        
        return redirect()->route('admin.categorias.index')->withSuccess('Categoría agregada correctamente.');
        
    }
    
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }
    
    
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        //actualizar la categoria
        $categoria->update($request->only('nombre_categoria', 'descripcion'));
        
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }
    
    
    public function destroy(Categoria $categoria)
    {
        //borrar la categoria
        $categoria->delete();
        
        return redirect()->route('admin.categorias.index')->withSuccess('Categoría eliminada correctamente.');
    }
    
    public function search(Request $request)
    {
        //buscador para categorias
        $query = $request->input('query');
        $categorias = Categoria::where('nombre_categoria', 'LIKE', "%$query%")->get();
        return response()->json($categorias);
    }
    
}
