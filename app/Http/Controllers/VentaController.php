<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Proveedor;


class VentaController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $categorias = Categoria::all();
        $productos = Producto::take(12)->get();
        $departamentos = Departamento::all();
        return view ('cliente.ventas.index',compact('categorias','productos','departamentos'));
    }
    
    public function listado_productos(Request $request)
    {
        $categoria_id = $request->query('categoria');
        $categoria_nombre = 'Todos los productos';
        
        // Filtra los productos por categoría si se ha seleccionado una
        if ($categoria_id) {
            $productos = Producto::where('id_categoria', $categoria_id)->paginate(7);
            $categoria = Categoria::find($categoria_id);
            $categoria_nombre = $categoria ? $categoria->nombre_categoria : 'Categoría desconocida';
        } else {
            $productos = Producto::paginate(8);
        }
        
        // Obtener las marcas únicas de los productos
        $marcas = Producto::whereNotNull('marca')
        ->distinct()
        ->pluck('marca');
        
        $categorias = Categoria::all();
        
        return view('cliente.ventas.listado_productos', compact('productos', 'categorias', 'categoria_nombre','marcas'));
    }
    
    public function detalle_producto($id)
    {
        $producto = Producto::with('proveedores')->findOrFail($id); // Cargar proveedores asociados
        $categorias = Categoria::all();
        $proveedor = $producto->proveedores->first(); 
        
        // Productos de la misma categoría
        $productosDeCategoria = Producto::where('id_categoria', $producto->id_categoria)
        ->where('id_producto', '!=', $id)
        ->inRandomOrder()
        ->take(6) // Número limitado
        ->get();
        
        // Productos de otras categorías
        $productosDeOtrasCategorias = Producto::where('id_categoria', '!=', $producto->id_categoria)
        ->where('id_producto', '!=', $id)
        ->inRandomOrder()
        ->take(6) // Número limitado
        ->get();
        
        // Combinar los resultados
        $productosRelacionados = $productosDeCategoria->merge($productosDeOtrasCategorias);
        
        
        return view('cliente.ventas.detalle_producto', compact('producto', 'categorias', 'proveedor', 'productosRelacionados'));
    }
    
    
    
    public function carrito()
    {
        $carrito = session()->get('carrito', []);
        $guardadosParaMasTarde = session()->get('guardadosParaMasTarde', []);
        
        return view('cliente.ventas.carrito', compact('carrito', 'guardadosParaMasTarde'));
    }
    
    public function agregarAlCarrito(Request $request)
    {
        // dd($request->all());
        $productoId = $request->input('producto_id');
        $proveedorId = $request->input('proveedor_id');
        $productoPrecio = $request->input('product_price');
        $productoStock = $request->input('product_stock');
        
        $producto = Producto::find($productoId);
        
        $proveedor = Proveedor::find($proveedorId);
        
        if ($proveedor) {
            $nombreProveedor = $proveedor->nombre_proveedor;
        } else {
            $nombreProveedor = 'Proveedor no encontrado'; // Manejo del error
        }
        
        
        if (!$producto) {
            return redirect()->route('cliente.ventas.listado_productos')->with('error', 'Producto no encontrado.');
        }
        
        $carrito = session()->get('carrito', []);
        
        // Crear una clave única combinando id_producto y id_proveedor
        $carritoKey = $productoId . '_' . $proveedorId;
        
        if (isset($carrito[$carritoKey])) {
            $carrito[$carritoKey]['cantidad']++;
        } else {
            $carrito[$carritoKey] = [
                'nombre' => $producto->nombre_producto,
                'precio' => $productoPrecio, 
                'stock' => $productoStock, 
                'cantidad' => 1,
                'imagen' => $producto->ruta_imagen,
                'descripcion' => $producto->descripcion,
                'proveedor_id' => $proveedorId,
                'nombre_proveedor' => $nombreProveedor,
            ];
        }
        
        session()->put('carrito', $carrito);
        
        return redirect()->route('cliente.ventas.detalle_producto', ['id' => $productoId])->with('success', 'Producto añadido al carrito.');
    }
    
    
    
    
    public function actualizarCarrito(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$validated['id']])) {
            $carrito[$validated['id']]['cantidad'] = $validated['cantidad'];
            session()->put('carrito', $carrito);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 400);
    }
    
    public function eliminarDelCarrito(Request $request)
    {
        $productoId = $request->input('id');
        
        // Verificar que el id del producto sea válido
        if (!$productoId) {
            return redirect()->route('cliente.ventas.carrito')->with('error', 'ID de producto no proporcionado.');
        }
        
        $carrito = session()->get('carrito', []);
        
        // Verificar si el producto está en el carrito
        if (isset($carrito[$productoId])) {
            unset($carrito[$productoId]);
            session()->put('carrito', $carrito);
            return redirect()->route('cliente.ventas.carrito')->with('success', 'Producto eliminado del carrito.');
        }
        
        // Si el producto no estaba en el carrito
        return redirect()->route('cliente.ventas.carrito')->with('error', 'Producto no encontrado en el carrito.');
    }
    
    
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        //
    }
}
