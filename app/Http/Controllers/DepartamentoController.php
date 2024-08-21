<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoCategoria;
use App\Models\Categoria;

class DepartamentoController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $departamentos = Departamento::with('categorias')->get();
        return view('admin.departamentos.index', compact('departamentos'));
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.departamentos.create', compact('categorias'));
    }
    
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        // Verifica los datos del formulario
        // dd($request->all());
        
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_departamento' => 'required|string|max:255',
            'categorias' => 'array', // Aceptar un array de IDs de categorías
            'categorias.*' => 'string' // Aceptar cadenas en lugar de enteros
        ]);
        
        // Crear el nuevo departamento
        $departamento = Departamento::create([
            'nombre_departamento' => $validated['nombre_departamento'],
        ]);
        
        // Dividir los IDs de categorías en un array
        $categoriaIds = explode(',', $validated['categorias'][0]);
        
        // Insertar las asociaciones en la tabla pivot
        foreach ($categoriaIds as $categoriaId) {
            DepartamentoCategoria::create([
                'id_departamento' => $departamento->id_departamento,
                'id_categoria' => (int) $categoriaId, // Convertir a entero
            ]);
        }
        
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('admin.departamentos.index')->with('success', 'Departamento creado con éxito.');
    }
    
    
    
    /**
    * Display the specified resource.
    */
    public function show(string $id)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    public function edit($id)
    {
        $departamento = Departamento::with('categorias')->findOrFail($id);
        $categorias = Categoria::all();
        
        return view('admin.departamentos.edit', compact('departamento', 'categorias'));
    }
    
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'nombre_departamento' => 'required|string|max:255',
            'categorias' => 'nullable|array',
            'categorias.*' => 'nullable|string',
        ]);
        
        // Encontrar el departamento y actualizar su nombre
        $departamento = Departamento::findOrFail($id);
        $departamento->update([
            'nombre_departamento' => $validated['nombre_departamento'],
        ]);
        
        // Eliminar todas las categorías asociadas actualmente
        DepartamentoCategoria::where('id_departamento', $departamento->id_departamento)->delete();
        
        // Si se proporcionan categorías, procesarlas
        if (isset($validated['categorias']) && !empty($validated['categorias'])) {
            // Convertir el array de IDs en enteros y eliminar valores no válidos
            $categoriaIds = array_filter(array_map('intval', explode(',', $validated['categorias'][0])), function ($id) {
                return $id > 0;
            });
            
            // Agregar las nuevas categorías
            foreach ($categoriaIds as $categoriaId) {
                DepartamentoCategoria::create([
                    'id_departamento' => $departamento->id_departamento,
                    'id_categoria' => $categoriaId,
                ]);
            }
        }
        
        return redirect()->route('admin.departamentos.index')->with('success', 'Departamento actualizado con éxito.');
    }
    
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        // Encuentra el departamento por ID
        $departamento = Departamento::find($id);
        
        // Verifica si el departamento tiene categorías asociadas
        if ($departamento->categorias->isNotEmpty()) {
            // Redirige con un mensaje de error si tiene categorías
            return redirect()->route('admin.departamentos.index')
            ->with('error', 'No se puede eliminar el departamento porque tiene categorías asociadas.');
        }
        
        // Si no tiene categorías, elimina el departamento
        $departamento->delete();
        
        // Redirige con un mensaje de éxito
        return redirect()->route('admin.departamentos.index')
        ->with('success', 'Departamento eliminado correctamente.');
    }
    
    
    
    public function searchCategorias(Request $request)
    {
        $query = $request->input('query');
        
        // Buscar categorías que coincidan con la consulta y que no estén asignadas a ningún departamento
        $categorias = Categoria::where('nombre_categoria', 'like', "%{$query}%")
        ->whereDoesntHave('departamentos')
        ->get();
        
        return response()->json($categorias);
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $departamentos = Departamento::where('nombre_departamento', 'LIKE', "%$query%")->get();
        return response()->json($departamentos);
    }
    
}
