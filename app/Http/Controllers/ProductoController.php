<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\ProductoProveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria', 'proveedores')->get();
        return view('admin.productos.index', compact('productos'));
    }
    
    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('admin.productos.create', compact('categorias', 'proveedores'));
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        // Validación de datos
        $request->validate([
            'nombre_producto' => 'required',
            'marca' => 'required',
            'categoria_id' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'required',
            'proveedor_id' => 'required|exists:proveedores,id_proveedor',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
        ]);
        
        // Procesar la imagen y guardarla en el sistema de archivos
        $imagenNombre = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('images'), $imagenNombre);
        
        // Guardar la ruta de la imagen en el campo correspondiente en la base de datos
        $path = '/images/' . $imagenNombre;
        
        // Crear el producto
        $producto = Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'id_categoria' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'marca' => $request->marca,
            'ruta_imagen' => $path,
        ]);
        
        // Asociar el proveedor con el producto
        ProductoProveedor::create([
            'id_producto' => $producto->id_producto,
            'id_proveedor' => $request->proveedor_id,
            'precio' => $request->precio,
            'stock' => $request->stock,
        ]);
        
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado con éxito.');
    }
    
    
    public function show($id)
    {
        $producto = Producto::with('proveedores')->findOrFail($id);
        return view('admin.productos.show', compact('producto'));
    }
    
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        $productoProveedores = ProductoProveedor::where('id_producto', $producto->id_producto)->get();
        return view('admin.productos.edit', compact('producto', 'categorias', 'proveedores', 'productoProveedores'));
    }
    
    public function update(Request $request, Producto $producto)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_producto' => 'required',
            'marca' => 'required',
            'categoria_id' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);
        
        // Preparar los datos del producto para la actualización
        $productoData = $request->only(['nombre_producto', 'categoria_id', 'descripcion', 'marca']);
        
        // Procesar la nueva imagen si se ha subido
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($producto->ruta_imagen && Storage::exists(str_replace('storage/', 'public/', $producto->ruta_imagen))) {
                Storage::delete(str_replace('storage/', 'public/', $producto->ruta_imagen));
            }
            
            // Almacenar la nueva imagen
            $imagenNombre = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images'), $imagenNombre);
            
            // Guardar la ruta de la imagen en el formato deseado
            $productoData['ruta_imagen'] = '/images/' . $imagenNombre;
        }
        
        // Actualizar los datos del producto
        $producto->update($productoData);
        
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado con éxito.');
    }
    
    public function destroy(Producto $producto)
    {
        ProductoProveedor::where('id_producto', $producto->id_producto)->delete();
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado con éxito.');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::where('nombre_producto', 'LIKE', "%$query%")->get();
        
        return response()->json($productos);
    }
    
    public function asignarProveedor()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('admin.productos.asignar_proveedor', compact('productos', 'proveedores'));
    }
    
    public function asignarProveedorStore(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id_producto',
            'proveedor_id' => 'required|exists:proveedores,id_proveedor',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        
        ProductoProveedor::create([
            'id_producto' => $request->producto_id,
            'id_proveedor' => $request->proveedor_id,
            'precio' => $request->precio,
            'stock' => $request->stock,
        ]);
        
        return redirect()->route('admin.productos.index')->with('success', 'Proveedor asignado al producto correctamente.');
    }
    
    public function updateProveedor(Request $request, $productoId, $proveedorId)
    {
        // Valida los datos
        $validated = $request->validate([
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        
        // Encuentra el producto al que se le actualizarán los datos del proveedor
        $producto = Producto::findOrFail($productoId);
        
        // Actualiza los datos en la tabla pivote
        $producto->proveedores()->updateExistingPivot($proveedorId, [
            'precio' => $validated['precio'],
            'stock' => $validated['stock'],
        ]);
        
        return redirect()->route('admin.productos.show', $productoId)
        ->with('success',[ 
            'message' => 'Producto actualizado con éxito',]);
        }
        
        public function destroyProveedor($productoId, $proveedorId)
        {
            // Encuentra el producto
            $producto = Producto::findOrFail($productoId);
            
            // Elimina la relación del proveedor con el producto
            $producto->proveedores()->detach($proveedorId);
            
            return redirect()->route('admin.productos.show', $productoId)
            ->with('success',[ 
                'message' => 'Proveedor eliminado correctamente',]);
                
            }
            
        }
        