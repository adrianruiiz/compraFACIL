@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna para Alta de Producto (más grande) -->
            <div class="col-span-2 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Asignar Proveedor a producto</h2>
                    <div class="overflow-x-auto">
                        <!-- Formulario para agregar productos -->
                        <form action="{{ route('admin.productos.asignar_proveedor_store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <!-- Campo de búsqueda de productos -->
                                <div class="mb-4">
                                    <label for="producto_search" class="block text-sm font-medium text-gray-700">Buscar Producto</label>
                                    <div class="relative mt-1">
                                        <input type="text" id="producto_search" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50]" placeholder="Escribe el nombre del producto..." autocomplete="off">
                                        <!-- Lista desplegable con sugerencias -->
                                        <ul id="producto_suggestions" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                            <!-- Las sugerencias se insertarán aquí mediante JavaScript -->
                                        </ul>
                                    </div>
                                    <input type="hidden" id="selected_producto" name="producto_id">
                                </div>
                            </div>
                            
                            <!-- Botón de envío -->
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                                    Asignar Proveedor
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Columna para Proveedores (más pequeña y con altura ajustada) -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg col-span-1 flex flex-col" style="height: 350px;">
                    <div class="p-6 text-gray-900 h-full">
                        <h2 class="text-2xl font-bold mb-4">Proveedor</h2>
                        <div class="overflow-x-auto">
                            <!-- Campo de búsqueda -->
                            <div class="mb-4">
                                <label for="proveedor_search" class="block text-sm font-medium text-gray-700">Buscar Proveedor</label>
                                <div class="relative mt-1">
                                    <input type="text" id="proveedor_search" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50]" placeholder="Escribe el nombre del proveedor..." autocomplete="off">
                                    <!-- Lista desplegable con sugerencias -->
                                    <ul id="proveedor_suggestions" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                        <!-- Las sugerencias se insertarán aquí mediante JavaScript -->
                                    </ul>
                                </div>
                                <input type="hidden" id="selected_proveedor" name="proveedor_id">
                            </div>
                            <div class="mb-4">
                                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                                <div class="mt-1">
                                    <input type="text" id="precio" name="precio" value="{{ old('precio') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('precio') border-red-500 @enderror" required>
                                    @error('precio')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <div class="mt-1">
                                    <input type="text" id="stock" name="stock" value="{{ old('stock') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('stock') border-red-500 @enderror" required>
                                    @error('stock')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Buscador de Proveedores
        const searchProveedorInput = document.getElementById('proveedor_search');
        const proveedorSuggestionsList = document.getElementById('proveedor_suggestions');
        const selectedProveedorInput = document.getElementById('selected_proveedor');
        
        searchProveedorInput.addEventListener('input', function() {
            const query = searchProveedorInput.value;
            console.log('Buscando proveedor:', query);
            if (query.length > 2) {
                fetch(`/search-proveedores?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Datos recibidos proveedores:', data); // Añade este log
                    proveedorSuggestionsList.innerHTML = '';
                    if (data.length > 0) {
                        proveedorSuggestionsList.classList.remove('hidden');
                        data.forEach(proveedor => {
                            const li = document.createElement('li');
                            li.textContent = proveedor.nombre_proveedor;
                            li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                            li.addEventListener('click', function() {
                                searchProveedorInput.value = proveedor.nombre_proveedor;
                                selectedProveedorInput.value = proveedor.id_proveedor;
                                proveedorSuggestionsList.classList.add('hidden');
                            });
                            proveedorSuggestionsList.appendChild(li);
                        });
                    } else {
                        proveedorSuggestionsList.classList.add('hidden');
                    }
                });
            } else {
                proveedorSuggestionsList.classList.add('hidden');
            }
        });
        
        document.addEventListener('click', function(event) {
            if (!searchProveedorInput.contains(event.target) && !proveedorSuggestionsList.contains(event.target)) {
                proveedorSuggestionsList.classList.add('hidden');
            }
        });
        
        // Buscador de Productos
        const searchProductoInput = document.getElementById('producto_search');
        const productoSuggestionsList = document.getElementById('producto_suggestions');
        const selectedProductoInput = document.getElementById('selected_producto');
        
        searchProductoInput.addEventListener('input', function() {
            const query = searchProductoInput.value;
            console.log('Buscando producto:', query);
            if (query.length > 2) {
                fetch(`/search-productos?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Datos recibidos productos:', data); // Añade este log
                    productoSuggestionsList.innerHTML = '';
                    if (data.length > 0) {
                        productoSuggestionsList.classList.remove('hidden');
                        data.forEach(producto => {
                            const li = document.createElement('li');
                            li.textContent = producto.nombre_producto;
                            li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                            li.addEventListener('click', function() {
                                searchProductoInput.value = producto.nombre_producto;
                                selectedProductoInput.value = producto.id_producto;
                                productoSuggestionsList.classList.add('hidden');
                            });
                            productoSuggestionsList.appendChild(li);
                        });
                    } else {
                        productoSuggestionsList.classList.add('hidden');
                    }
                });
            } else {
                productoSuggestionsList.classList.add('hidden');
            }
        });
        
        document.addEventListener('click', function(event) {
            if (!searchProductoInput.contains(event.target) && !productoSuggestionsList.contains(event.target)) {
                productoSuggestionsList.classList.add('hidden');
            }
        });
    });
    
</script>
@endsection
