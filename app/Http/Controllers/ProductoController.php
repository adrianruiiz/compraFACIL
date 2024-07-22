<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\ProductoProveedor;
use Illuminate\Http\Request;

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
            'categoria_id' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'required',
            'proveedor_id' => 'required|exists:proveedores,id_proveedor',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
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
        $request->validate([
            'nombre_producto' => 'required',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'nullable',
            'ruta_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'proveedores' => 'required|array',
            'proveedores.*.id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'proveedores.*.precio' => 'nullable|numeric',
            'proveedores.*.stock' => 'nullable|integer',
        ]);
        
        // Actualizar datos del producto
        $productoData = $request->only(['nombre_producto', 'id_categoria', 'descripcion', 'ruta_imagen']);
        $producto->update($productoData);
        
        // Eliminar las relaciones actuales y crear las nuevas
        ProductoProveedor::where('id_producto', $producto->id_producto)->delete();
        foreach ($request->proveedores as $proveedorData) {
            ProductoProveedor::create([
                'id_producto' => $producto->id_producto,
                'id_proveedor' => $proveedorData['id_proveedor'],
                'precio' => $proveedorData['precio'] ?? null,
                'stock' => $proveedorData['stock'] ?? null,
            ]);
        }
        
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
    
    
    
}
