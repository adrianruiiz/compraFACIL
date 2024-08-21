@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna para Alta de Producto (más grande) -->
            <div class="col-span-3 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Editar Producto</h2>
                    <div class="overflow-x-auto">
                        <!-- Formulario para editar productos -->
                        <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <!-- Campo para el nombre del producto -->
                                <div class="mb-4">
                                    <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <div class="mt-1">
                                        <input type="text" id="nombre_producto" name="nombre_producto" value="{{ old('nombre_producto', $producto->nombre_producto) }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('nombre_producto') border-red-500 @enderror" required>
                                        @error('nombre_producto')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Campo de búsqueda de categoría -->
                                <div class="mb-4">
                                    <div class="flex space-x-4">
                                        <div class="w-1/2">
                                            <label for="categoria_search" class="block text-sm font-medium text-gray-700">Buscar Categoría</label>
                                            <div class="relative mt-1">
                                                <input type="text" id="categoria_search" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50]" placeholder="Escribe el nombre de la categoría..." autocomplete="off" value="{{ old('categoria_search', $producto->categoria->nombre_categoria ?? '') }}">
                                                <!-- Lista desplegable con sugerencias -->
                                                <ul id="categoria_suggestions" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden">
                                                    <!-- Las sugerencias se insertarán aquí mediante JavaScript -->
                                                </ul>
                                            </div>
                                            <input type="hidden" id="selected_categoria" name="categoria_id" value="{{ old('categoria_id', $producto->id_categoria) }}">
                                        </div>
                                        
                                        <div class="w-1/2">
                                            <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                                            <div class="relative mt-1">
                                                <input type="text" id="marca" name="marca" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50]" placeholder="Escribe el nombre de la marca del producto..." value="{{ old('marca', $producto->marca) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Campo para la descripción del producto -->
                                <div class="mb-4">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <div class="mt-1">
                                        <textarea id="descripcion" name="descripcion" rows="4" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                        @error('descripcion')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Campo para la carga de imagen -->
                                <div class="mb-4 flex justify-center">
                                    <div class="w-[400px] relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                                        <input type="file" class="absolute inset-0 w-full h-full opacity-0 z-50" id="file-upload" name="imagen" accept="image/*"/>
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
                                        <img src="{{ $producto->ruta_imagen }}" class="mt-4 mx-auto max-h-40 {{ $producto->ruta_imagen ? '' : 'hidden' }}" id="preview">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Botón de envío -->
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                                    Actualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchCategoriaInput = document.getElementById('categoria_search');
        const categoriaSuggestionsList = document.getElementById('categoria_suggestions');
        const selectedCategoriaInput = document.getElementById('selected_categoria');
        
        searchCategoriaInput.addEventListener('input', function() {
            const query = searchCategoriaInput.value;
            if (query.length > 1) {
                fetch(`/search-categoriasPR?query=${query}`)
                .then(response => response.json())
                .then(data => {
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
