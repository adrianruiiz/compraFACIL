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
        $categorias = Categoria::with('departamentos')->get();
        $departamentos = Departamento::all();
        return view('admin.categorias.index', compact('categorias','departamentos'));
    }
    
    public function create()
    {
        $departamentos = Departamento::all();
        return view('admin.categorias.create', compact('departamentos'));
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        
        $categoria = Categoria::create($request->only('nombre_categoria', 'descripcion'));
        
        DepartamentoCategoria::create([
            'id_departamento' => $request->departamento_id,
            'id_categoria' => $categoria->id_categoria,
        ]);
        
        return redirect()->route('admin.categorias.index')->withSuccess('Categoría agregada correctamente.');
        
    }
    
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }
    
    public function edit(Categoria $categoria)
    {
        $departamentos = Departamento::all();
        return view('admin.categorias.edit', compact('categoria', 'departamentos'));
    }
    
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'departamentos' => 'array',
            'departamentos.*' => 'exists:departamentos,id_departamento',
        ]);
        
        $categoria->update($request->only('nombre_categoria', 'descripcion'));
        
        if ($request->has('departamentos')) {
            $categoria->departamentos()->sync($request->departamentos);
        }
        
        return redirect()->route('admin.categorias.index');
    }
    
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        
        return redirect()->route('admin.categorias.index')->withSuccess('Categoría eliminada correctamente.');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categorias = Categoria::where('nombre_categoria', 'LIKE', "%$query%")->get();
        return response()->json($categorias);
    }
    
}
