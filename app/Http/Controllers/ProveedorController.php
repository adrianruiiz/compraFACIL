<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\ProductoProveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index()
    {
        //obtener proveedores y mandarlos a la vista
        $proveedores = Proveedor::with('productos')->get();
        return view('admin.proveedores.index', compact('proveedores'));
    }
    
    public function create()
    {
        return view('admin.proveedores.create');
    }
    
    public function store(StoreProveedorRequest $request)
    {
        //insert en la tabla proveedores
        Proveedor::create($request->validated());
        
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor creado con éxito.');
    }
    
    public function show(Proveedor $proveedor)
    {
        return view('admin.proveedores.show', compact('proveedor'));
    }
    
    public function edit($id)
    {
        \Log::info('ID en edit: ' . $id); // Debugging
        
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }
    
    public function update(UpdateProveedorRequest $request, $id)
    {
        // Añadir el ID a la solicitud
        $request->merge(['id_proveedor' => $id]);
        
        $proveedor = Proveedor::findOrFail($id);
        
        $proveedor->update($request->validated());
        
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor actualizado con éxito.');
    }
    
    
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        
        //\Log::info('Eliminando proveedor con ID: ' . $proveedor->id_proveedor); // Debugging
        
        $proveedor->delete();
        
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor eliminado con éxito.');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $proveedores = Proveedor::where('nombre_proveedor', 'LIKE', "%$query%")->get();
        
        return response()->json($proveedores);
    }
    
}
