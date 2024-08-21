<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PedidoController;

// if (!$user || $user->rol !== 'admin') {
//     abort(403, 'No tienes permiso para acceder a esta página.');
// }


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/informacion', function () {
    return view('informacion');
})->name('info');


Route::middleware(['auth', 'verified'])->group(function () {
    $user = Auth::user();
    
    if (!$user || $user->rol == 'admin') {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('categorias', CategoriaController::class);
            Route::resource('proveedores', ProveedorController::class);
            Route::resource('productos', ProductoController::class);
            Route::get('asignar_proveedor', [ProductoController::class, 'asignarProveedor'])->name('productos.asignar_proveedor');
            Route::post('asignar_proveedor', [ProductoController::class, 'asignarProveedorStore'])->name('productos.asignar_proveedor_store');
            Route::resource('departamentos', DepartamentoController::class);
            Route::put('productos/{producto}/proveedores/{proveedor}', [ProductoController::class, 'updateProveedor'])->name('productos.updateProveedor');
            Route::delete('productos/{producto}/proveedores/{proveedor}', [ProductoController::class, 'destroyProveedor'])->name('productos.proveedores.destroy');

        });
    }
    if (!$user || $user->rol == 'cliente') {
        
        Route::prefix('cliente')->name('cliente.')->group(function () {
            Route::resource('ventas', VentaController::class);
            Route::get('listado_productos', [VentaController::class, 'listado_productos'])->name('ventas.listado_productos');
            Route::get('detalle_producto/{id}', [VentaController::class, 'detalle_producto'])->name('ventas.detalle_producto');
            
            // carrito
            Route::get('carrito', [VentaController::class, 'carrito'])->name('ventas.carrito');
            Route::post('carrito/agregar', [VentaController::class, 'agregarAlCarrito'])->name('carrito.agregarAlCarrito');
            Route::post('/carrito/actualizar', [VentaController::class, 'actualizarCarrito'])->name('carrito.actualizar');
            Route::post('/carrito/eliminar', [VentaController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
            
            Route::post('/pedidos/store', [PedidoController::class, 'store'])->name('carrito.pedidos.store');
            
            // routes/web.php
            Route::get('pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
            // routes/web.php
            Route::get('detalles_pedido/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
            Route::post('/pedido/{id}/finalizar', [PedidoController::class, 'finalizarPedido'])->name('pedido.finalizar');
            Route::get('/pedidoPDF/{id}/pdf', [PdfController::class, 'exportToPdf'])->name('pedido.pdf');
            
            
            // web.php
            Route::get('/carrito/contar', function () {
                // Obtén el carrito del usuario
                $carrito = session()->get('carrito', []);
                
                // Calcula la cantidad total de productos
                $cantidadTotal = array_sum(array_column($carrito, 'cantidad'));
                
                return response()->json(['success' => true, 'cantidadTotal' => $cantidadTotal]);
            });
            
            
        });
    }
    
    
    
    Route::get('/search-proveedores', [ProveedorController::class, 'search'])->name('search.proveedores');
    Route::get('/search-productos', [ProductoController::class, 'search'])->name('search.productos');
    Route::get('/search-categoriasPR', [CategoriaController::class, 'search'])->name('search.categorias');
    Route::get('/search-departamentos', [DepartamentoController::class, 'search'])->name('search.departamentos');
    Route::get('/search-categorias', [DepartamentoController::class, 'searchCategorias'])->name('search.categorias');
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
