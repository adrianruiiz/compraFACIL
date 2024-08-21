@extends('layouts.app')
@section('content')

<div class="container mx-auto py-2">
    {{-- ruta --}}
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-blue-700 hover:text-purple-600 dark:text-blue-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Tienda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-blue-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-blue-700 hover:text-purple-600 md:ms-2 dark:text-blue-400 dark:hover:text-white">Departamento</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-blue-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-blue-500 md:ms-2 dark:text-blue-400">Categoria</span>
                </div>
            </li>
        </ol>
    </nav>
    
    <!-- Despues de agregar o eliminar -->
    @if (session('success'))
    <div id="alert-3" class="flex items-center p-4 mb-4 rounded-lg bg-green-50 bg-green-500 text-white" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <!-- Product Details -->
    <div class="bg-white md:space-x-2 p-6 rounded-lg shadow flex">
        <!-- Image and Thumbnails -->
        <div class="w-1/4">
            <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="w-full h-auto mb-4 rounded-md border border-gray-200">
            <div class="flex space-x-2 justify-center">
                <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="border border-gray-200 w-20 h-20 object-cover rounded-md cursor-pointer">
                <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="border border-gray-200 w-20 h-20 object-cover rounded-md cursor-pointer">
                <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="border border-gray-200 w-20 h-20 object-cover rounded-md cursor-pointer">
            </div>            
        </div>
        
        <!-- Producto Info -->
        <div class="w-2/4 pl-6 rounded-md border border-gray-200">
            @php
            $currentProveedor = $producto->proveedores->first();
            $currentStock = $currentProveedor ? $currentProveedor->pivot->stock : 0;
            $currentPrecio = $currentProveedor ? $currentProveedor->pivot->precio : 0;
            @endphp
            
            <div id="stock-status" class="mb-1">
                @if($currentStock > 0)
                <span class="py-1 text-green-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span id="current-stock">En stock ({{ $currentStock }})</span>
                </span>
                @else
                <span class="text-red-600 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 3a7 7 0 11-7 7 7 7 0 017-7zm0 2a5 5 0 00-5 5 5 5 0 005 5 5 5 0 000-10zm-1 1a1 1 0 10-2 0 1 1 0 002 0zm2 1a1 1 0 10-2 0 1 1 0 002 0z"/>
                    </svg>
                    <span id="current-stock">Sin stock</span>
                </span>
                @endif
            </div>
            
            <h1 class="text-xl font-bold mb-2">{{ $producto->nombre_producto }}</h1>
            <p class="text-gray-700 mb-4">{{ $producto->descripcion }}</p>
            <div class="flex items-center mb-4">
                <span class="text-yellow-500">★★★★☆</span>
                <span class="text-gray-700 ml-2">{{ $producto->calificaciones }} reviews</span>
                <span class="text-gray-700 ml-2">{{ $producto->ventas }} sold</span>
            </div>
            <div class="flex items-center mb-4">
                <span class="text-xl font-bold text-green-600" id="product-price">${{ number_format($currentPrecio, 2) }}</span>
                <span class="line-through text-gray-500 ml-2">${{ number_format($currentPrecio + ($currentPrecio *.80), 2) }}</span>
            </div>
            <form action="{{ route('cliente.carrito.agregarAlCarrito') }}" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto->id_producto }}">
                <input type="hidden" id="proveedor-id-input" name="proveedor_id" value="{{ $currentProveedor ? $currentProveedor->id_proveedor : '' }}">
                <input type="hidden" id="product-price-input" name="product_price" value="{{ $currentPrecio }}">
                <input type="hidden" id="product-stock-input" name="product_stock" value="{{ $currentStock }}">
                <button class="mt-2 border border-gray-200 bg-green-500 text-white font-semibold px-4 py-2 rounded-md flex items-center justify-center space-x-2 hover:bg-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span>Añadir al carrito</span>
                </button>
            </form>
            
        </div>                    
        
        <!-- Proveedor -->
        <div class="w-1/4 h-1/2 bg-white p-6 rounded-md border border-gray-200 mr-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                    <span class="text-teal-800 text-lg font-bold" id="proveedor-nombre">{{ strtoupper(substr($currentProveedor->nombre_proveedor, 0, 1)) }}</span>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Proveedor</h3>
                    {{-- <p class="text-gray-500">{{ $currentProveedor->nombre_proveedor }}</p> --}}
                    <button id="proveedor-button" class="flex items-center text-lg font-semibold text-gray-700 hover:text-gray-900">
                        {{ $currentProveedor ? $currentProveedor->nombre_proveedor : 'Seleccionar proveedor' }}
                        <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 9l-7.5 7.5L4.5 9" />
                        </svg>
                    </button>
                    <div id="proveedor-dropdown" class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden">
                        <ul class="py-1">
                            @foreach($producto->proveedores as $proveedor)
                            @php 
                            $stock = $proveedor->pivot->stock;
                            $precio = $proveedor->pivot->precio;
                            @endphp
                            <li>
                                <a href="#" 
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-precio="{{ $precio }}" 
                                data-stock="{{ $stock }}" 
                                data-nombre="{{ $proveedor->nombre_proveedor }}"
                                data-direccion="{{ $proveedor->direccion }}"
                                data-id="{{ $proveedor->id_proveedor }}">
                                {{ $proveedor->nombre_proveedor }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <hr class="py-1">
        
        <div class="flex items-center text-gray-500 mb-2">
            <svg class="w-6 h-6 text-gray-800 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
            </svg>
            <span id="proveedor-direccion">{{ $currentProveedor->direccion }}</span>
        </div>
        <div class="flex items-center text-gray-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-800 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
            <p>Vendedor verificado</p>
        </div>
        {{-- <br>
        <a href="#" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 block w-full mb-2 text-center">Consultar</a>
        <a href="#" class="border border-gray-100 p-2 rounded-md text-green-500 hover:underline block w-full mb-2 text-center">Perfil del vendedor</a> --}}
    </div>
</div>

<!-- detalles y productos relacionados -->
<div class="container mx-auto py-6">
    <div class="flex space-x-6">
        <div class="w-3/4 bg-white p-6 rounded-lg shadow">
            <div>
                <h2 class="text-xl font-bold mb-4">Comparativa de Precios</h2>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 border-b text-left">Proveedor</th>
                                <th class="px-4 py-2 border-b text-left">Precio</th>
                                <th class="px-4 py-2 border-b text-left">Stock</th>
                                <th class="px-4 py-2 border-b text-left">Enlace</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($producto->proveedores as $proveedor)
                            @php
                            $stock = $proveedor->pivot->stock;
                            $precio = $proveedor->pivot->precio;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $proveedor->nombre_proveedor }}</td>
                                <td class="px-4 py-2 border-b">${{ number_format($precio, 2) }}</td>
                                <td class="px-4 py-2 border-b">{{ $stock > 0 ? 'Disponible' : 'Sin stock' }}</td>
                                <td class="px-4 py-2 border-b">
                                    @if($stock > 0)
                                    <a href="#" class="text-blue-500 hover:underline">Comprar</a>
                                    @else
                                    <span class="text-red-500">Agotado</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- "Te podría gustar" -->
        <div class="w-1/4 bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Te podría gustar</h2>
            <ul>
                @foreach($productosRelacionados as $relacionado)
                @foreach($relacionado->proveedores as $proveedor)
                <li class="flex items-center mb-4">
                    <img src="{{ $relacionado->ruta_imagen }}" alt="{{ $relacionado->nombre_producto }}" class="w-20 h-20 object-cover rounded-md mr-4">
                    <div>
                        <h3 class="text-sm font-semibold">{{ $relacionado->nombre_producto }}</h3>
                        <!-- Asegúrate de que el precio se obtiene del pivote -->
                        <p class="text-gray-700">${{ number_format($proveedor->pivot->precio ?? 0, 2) }}</p>
                    </div>
                </li>
                @endforeach
                @endforeach
            </ul>
        </div>
        
    </div>
</div>

@php
use Illuminate\Support\Str;
@endphp

<!-- Productos relacionados -->
<div class="bg-white p-6 mt-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Productos relacionados</h2>
    <div class="flex space-x-4">
        @foreach($productosRelacionados as $relacionado)
        @foreach($relacionado->proveedores as $proveedor)
        <div class="w-1/6">
            <img src="{{ $relacionado->ruta_imagen }}" alt="{{ $relacionado->nombre_producto }}" class="w-25 h-auto rounded-md">
            <h3 class="text-sm font-semibold mt-2">{{ Str::limit($relacionado->nombre_producto, 20, '...') }}</3>
            <p class="text-gray-700">${{ number_format($proveedor->pivot->precio ?? 0, 2) }}</p>
            <a href="{{ route('cliente.ventas.detalle_producto', ['id' => $relacionado->id_producto]) }}" class="text-green-500 hover:underline">Ver producto</a>
        </div>
        @endforeach
        @endforeach
    </div>
</div>

<!-- Promo Banner -->
<div class="bg-green-500 text-white p-6 mt-6 rounded-lg shadow text-center">
    <p class="text-xl font-semibold">Llévate $200 pesos de mandado GRATIS en tu primera compra</p>
    <a href="#" class="bg-white text-green-500 py-2 px-4 rounded-lg mt-4 inline-block">Comprar ahora</a>
</div>
<br><br>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const proveedorButton = document.getElementById('proveedor-button');
        const proveedorDropdown = document.getElementById('proveedor-dropdown');
        const proveedorNombre = document.getElementById('proveedor-nombre');
        const proveedorDireccion = document.getElementById('proveedor-direccion');
        const productPriceElement = document.getElementById('product-price');
        const productStockElement = document.getElementById('current-stock');
        const productPriceInput = document.getElementById('product-price-input');
        const productStockInput = document.getElementById('product-stock-input');
        
        // Mostrar/Ocultar el dropdown de proveedores
        proveedorButton.addEventListener('click', function () {
            proveedorDropdown.classList.toggle('hidden');
        });
        
        // Actualizar los datos del proveedor seleccionado
        proveedorDropdown.querySelectorAll('a').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.preventDefault();
                const nombre = this.getAttribute('data-nombre');
                const precio = parseFloat(this.getAttribute('data-precio')).toFixed(2);
                const stock = this.getAttribute('data-stock');
                const direccion = this.getAttribute('data-direccion');
                const proveedorId = this.getAttribute('data-id');

                document.getElementById('proveedor-id-input').value = proveedorId;

                // Actualizar los elementos con los nuevos datos del proveedor
                proveedorNombre.innerText = nombre.charAt(0).toUpperCase();
                productPriceElement.innerText = `$${precio}`;
                productStockElement.innerText = stock > 0 ? `En stock (${stock})` : 'Sin stock';
                proveedorDireccion.innerText = direccion;
                
                // Actualizar los valores ocultos del formulario
                productPriceInput.value = precio;
                productStockInput.value = stock;
                
                // Ocultar el dropdown
                proveedorDropdown.classList.add('hidden');
            });
        });
        
        // Ocultar el dropdown si se hace clic fuera de él
        document.addEventListener('click', function (e) {
            if (!proveedorButton.contains(e.target) && !proveedorDropdown.contains(e.target)) {
                proveedorDropdown.classList.add('hidden');
            }
        });
        
        // Selecciona el elemento de la alerta
        var alert = document.getElementById('alert-3');
        
        // Si el elemento de alerta existe
        if (alert) {
            // Configura un temporizador para ocultar la alerta después de 2 segundos (2000 milisegundos)
            setTimeout(function() {
                alert.style.opacity = 0;
                alert.style.transition = 'opacity 0.5s ease-out'; // Agrega una transición suave al desvanecimiento
                // Espera a que la transición termine antes de ocultar el elemento
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }, 2000);
        }
        
        // cerrar el modal
        document.addEventListener('click', function (event) {
            if (!proveedorButton.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
    
</script>

@endsection
