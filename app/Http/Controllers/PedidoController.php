<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\ProductoProveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        // Fetch orders for the authenticated user based on the id_cliente
        $pedidos = Pedido::where('id_cliente', auth()->id())->get();
        $pedidosRealizados = Pedido::where('estado', 'Realizado')
        ->where('id_cliente', Auth::id())
        ->get();

        return view('cliente.ventas.pedidos', compact('pedidos','pedidosRealizados'));
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
        // Validar los datos del request
        $data = $request->validate([
            'id_cliente' => 'required|integer',
            'productos' => 'required|array',
            'productos.*.id' => 'required|string',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'descuento' => 'required|numeric',
            'iva' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        
        // Iniciar una transacción
        DB::beginTransaction();
        
        try {
            // Generar un código único para el pedido
            do {
                $codigoPedido = strtoupper(Str::random(10)); // Genera un código de 10 caracteres alfanuméricos
            } while (Pedido::where('codigo_pedido', $codigoPedido)->exists());
            
            // Crear el pedido
            $pedido = Pedido::create([
                'id_cliente' => $data['id_cliente'],
                'subtotal' => $data['subtotal'],
                'descuento' => $data['descuento'],
                'iva' => $data['iva'],
                'total' => $data['total'],
                'estado' => 'Proceso',
                'codigo_pedido' => $codigoPedido,
            ]);
            
            // Crear detalles del pedido
            foreach ($data['productos'] as $producto) {
                // Separar id_producto y id_proveedor
                list($id_producto, $id_proveedor) = explode('_', $producto['id']);
                DetallePedido::create([
                    'id_pedido' => $pedido->id_pedido,
                    'id_producto' => $id_producto,
                    'id_proveedor' => $id_proveedor,
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['precio'],
                ]);
            }
            
            // Confirmar la transacción
            DB::commit();
            
            // Vaciar el carrito
            session()->forget('carrito');
            
            // Redirigir a la ruta con un mensaje de éxito
            return redirect()->route('dashboard')->with('success', [
                'message' => 'Pedido realizado con éxito',
                'pedido_id' => $pedido->id_pedido
            ]);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            // Mostrar mensaje de error y detalle de la excepción
            return back()->withErrors('Error al realizar el pedido: ' . $e->getMessage());
        }
    }
    
    public function finalizarPedido($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        // Actualizar estado del pedido a "Realizado"
        $pedido->estado = 'Realizado';
        $pedido->save();
        
        // Actualizar stock de los productos en la tabla productos_proveedores
        foreach ($pedido->detalles as $detalle) {
            $productoProveedor = ProductoProveedor::where('id_producto', $detalle->id_producto)
            ->where('id_proveedor', $detalle->id_proveedor)
            ->first();
            
            if ($productoProveedor) {
                $productoProveedor->stock -= $detalle->cantidad;
                $productoProveedor->save();
            }
        }
        
        return redirect()->route('cliente.pedidos.index')->with('success',[ 
            'message' => 'Pedido realizado con éxito',]);
        }   

        public function show($id)
        {
            
            $pedido = Pedido::with('detalles.producto')->findOrFail($id);
            return view('cliente.ventas.sidebar_detalle', compact('pedido')); 
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
    