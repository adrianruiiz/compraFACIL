<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\DepartamentoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
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
    });
    
    Route::get('/search-proveedores', [ProveedorController::class, 'search'])->name('search.proveedores');
    Route::get('/search-productos', [ProductoController::class, 'search'])->name('search.productos');
    Route::get('/search-categorias', [CategoriaController::class, 'search'])->name('search.categorias');
    Route::get('/search-departamentos', [DepartamentoController::class, 'search'])->name('search.departamentos');
    Route::get('/search-categorias', [DepartamentoController::class, 'searchCategorias'])->name('search.categorias');
    
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
