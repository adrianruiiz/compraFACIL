@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="col-span-2 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Alta de Departamento</h2>
                    <div class="overflow-x-auto">
                        <form action="{{ route('admin.departamentos.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <!-- Campo para el nombre del departamento -->
                                <div class="mb-4">
                                    <label for="nombre_departamento" class="block text-sm font-medium text-gray-700">Nombre del departamento</label>
                                    <div class="mt-1">
                                        <input type="text" id="nombre_departamento" name="nombre_departamento" value="{{ old('nombre_departamento') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('nombre_departamento') border-red-500 @enderror" required>
                                        @error('nombre_departamento')
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
                                </div>
                                
                                <!-- Campo oculto para el array de categorías -->
                                <input type="hidden" id="categorias_input" name="categorias[]">
                                
                                <!-- Botón de envío -->
                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                                        Añadir
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
            
            <!-- Columna para las categorias -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg col-span-1 flex flex-col" style="height: 350px;">
                <div class="p-6 text-gray-900 h-full">
                    <h2 class="text-2xl font-bold mb-4">Categorías del departamento</h2>
                    <div class="overflow-x-auto" id="selected_categorias_container">
                        {{-- AQUI SE MOSTRARAN LAS CATEGORIAS SELECCIONADAS --}}
                        
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
        const selectedCategoriasContainer = document.getElementById('selected_categorias_container');
        const categoriasInput = document.getElementById('categorias_input');

        // Almacena los IDs de las categorías ya seleccionadas
        const selectedCategoriaIds = new Set();

        searchCategoriaInput.addEventListener('input', function() {
            const query = searchCategoriaInput.value;
            if (query.length > 2) {
                fetch(`/search-categorias?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    categoriaSuggestionsList.innerHTML = '';
                    if (data.length > 0) {
                        categoriaSuggestionsList.classList.remove('hidden');
                        data.forEach(categoria => {
                            if (!selectedCategoriaIds.has(categoria.id_categoria)) {
                                const li = document.createElement('li');
                                li.textContent = categoria.nombre_categoria;
                                li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                                li.addEventListener('click', function() {
                                    agregarCategoriaSeleccionada(categoria);
                                    searchCategoriaInput.value = '';
                                    categoriaSuggestionsList.classList.add('hidden');
                                });
                                categoriaSuggestionsList.appendChild(li);
                            }
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

        function agregarCategoriaSeleccionada(categoria) {
            if (selectedCategoriaIds.has(categoria.id_categoria)) return; // No agregar si ya está seleccionada

            const div = document.createElement('div');
            div.classList.add('selected-categoria', 'p-2', 'mb-2', 'bg-gray-200', 'rounded', 'flex', 'items-center', 'justify-between');
            div.textContent = categoria.nombre_categoria;

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'categorias[]'; // Nombre del campo para enviar el array de IDs
            hiddenInput.value = categoria.id_categoria;

            const removeButton = document.createElement('button');
            removeButton.textContent = 'Eliminar';
            removeButton.classList.add('px-2', 'py-1', 'bg-red-500', 'text-white', 'text-sm', 'font-medium', 'rounded', 'hover:bg-red-600');
            removeButton.addEventListener('click', function() {
                eliminarCategoriaSeleccionada(categoria.id_categoria, div);
            });

            div.appendChild(removeButton);
            div.appendChild(hiddenInput);
            selectedCategoriasContainer.appendChild(div);
            selectedCategoriaIds.add(categoria.id_categoria); // Añadir al conjunto de IDs seleccionados
            
            // Actualizar el input oculto con los IDs seleccionados
            actualizarCategoriasInput();
        }

        function eliminarCategoriaSeleccionada(categoriaId, div) {
            div.remove();
            selectedCategoriaIds.delete(categoriaId); // Eliminar del conjunto de IDs seleccionados
            
            // Actualizar el input oculto con los IDs seleccionados
            actualizarCategoriasInput();
        }
        
        function actualizarCategoriasInput() {
            // Limpiar el valor actual
            categoriasInput.value = '';
            
            // Asignar los IDs de las categorías como valor del input oculto
            categoriasInput.value = Array.from(selectedCategoriaIds).join(',');
        }
    });
</script>
@endsection
