@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna para Alta de Producto (más grande) -->
            <div class="col-span-2 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Alta de Producto</h2>
                    <div class="overflow-x-auto">
                        <!-- Formulario para agregar productos -->
                        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <!-- Campo para el nombre del producto -->
                                <div class="mb-4">
                                    <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <div class="mt-1">
                                        <input type="text" id="nombre_producto" name="nombre_producto" value="{{ old('nombre_producto') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('nombre_producto') border-red-500 @enderror" required>
                                        @error('nombre_producto')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Campo de búsqueda de categoría -->
                                <div class="mb-4">
                                    <label for="categoria_search" class="block text-sm font-medium text-gray-700">Buscar Categoría</label>
                                    <div class="relative mt-1">
                                        <input type="text" id="categoria_search" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50]" placeholder="Escribe el nombre de la categoría..." autocomplete="off">
                                        <!-- Lista desplegable con sugerencias -->
                                        <ul id="categoria_suggestions" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                            <!-- Las sugerencias se insertarán aquí mediante JavaScript -->
                                        </ul>
                                    </div>
                                    <input type="hidden" id="selected_categoria" name="categoria_id">
                                </div>
                                
                                <!-- Campo para la descripción del producto -->
                                <div class="mb-4">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <div class="mt-1">
                                        <textarea id="descripcion" name="descripcion" rows="4" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('descripcion') border-red-500 @enderror"></textarea>
                                        @error('descripcion')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Campo para la carga de imagen -->
                                <div class="mb-4 flex justify-center">
                                    <div class="w-[400px] relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                                        <input type="file" class="absolute inset-0 w-full h-full opacity-0 z-50" id="file-upload" name="imagen" accept="image/*" required/>
                                        <div class="text-center" id="dropzone-content">
                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                <label for="file-upload" class="relative cursor-pointer">
                                                    <span>Arrastra una imagen</span>
                                                    <span class="text-indigo-600"> o busca una</span>
                                                </label>
                                            </h3>
                                            <p class="mt-1 text-xs text-gray-500">
                                                PNG, JPG, GIF 
                                            </p>
                                        </div>
                                        <img src="" class="mt-4 mx-auto max-h-40 hidden" id="preview">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Botón de envío -->
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                                    Añadir
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
        
        const searchCategoriaInput = document.getElementById('categoria_search');
        const categoriaSuggestionsList = document.getElementById('categoria_suggestions');
        const selectedCategoriaInput = document.getElementById('selected_categoria');
        
        searchCategoriaInput.addEventListener('input', function() {
            const query = searchCategoriaInput.value;
            console.log('Buscando categoría:', query);
            if (query.length > 2) {
                fetch(`/search-categorias?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Datos recibidos categorías:', data); // Añade este log
                    categoriaSuggestionsList.innerHTML = '';
                    if (data.length > 0) {
                        categoriaSuggestionsList.classList.remove('hidden');
                        data.forEach(categoria => {
                            const li = document.createElement('li');
                            li.textContent = categoria.nombre_categoria;
                            li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                            li.addEventListener('click', function() {
                                searchCategoriaInput.value = categoria.nombre_categoria;
                                selectedCategoriaInput.value = categoria.id_categoria;
                                categoriaSuggestionsList.classList.add('hidden');
                            });
                            categoriaSuggestionsList.appendChild(li);
                        });
                    } else {
                        categoriaSuggestionsList.classList.add('hidden');
                    }
                });
            } else {
                categoriaSuggestionsList.classList.add('hidden');
            }
        });
        
        document.addEventListener('click', function(event) {
            if (!searchCategoriaInput.contains(event.target) && !categoriaSuggestionsList.contains(event.target)) {
                categoriaSuggestionsList.classList.add('hidden');
            }
        });
        
        const fileUploadInput = document.getElementById('file-upload');
        const previewImage = document.getElementById('preview');
        
        fileUploadInput.addEventListener('change', function() {
            const file = fileUploadInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    document.getElementById('dropzone-content').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                document.getElementById('dropzone-content').classList.remove('hidden');
            }
        });
    });
</script>
@endsection
