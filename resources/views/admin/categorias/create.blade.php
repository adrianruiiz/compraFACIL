@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna para Alta de Categorías (más grande) -->
            <div class="col-span-2 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Alta de Categorías</h2>
                    <div class="overflow-x-auto">
                        <!-- Formulario para agregar categorías -->
                        <form action="{{ route('admin.categorias.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <!-- Campo para el nombre de la categoría -->
                                <div class="mb-4">
                                    <label for="nombre_categoria" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <div class="mt-1">
                                        <input type="text" id="nombre_categoria" name="nombre_categoria" value="{{ old('nombre_categoria') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('nombre_categoria') border-red-500 @enderror" required>
                                        @error('nombre_categoria')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Campo para la descripción de la categoría -->
                                <div class="mb-4">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <div class="mt-1">
                                        <textarea id="descripcion" name="descripcion" rows="4" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('descripcion') border-red-500 @enderror"></textarea>
                                        @error('descripcion')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
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
                
                <!-- Columna opcional para Departamentos (más pequeña) -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg" style="height: 200px;">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-bold mb-4">Departamento (Opcional)</h2>
                        <!-- Campo de búsqueda -->
                        <div class="space-y-4">
                            
                            <div class="mb-4">
                                <label for="departamento_search" class="block text-sm font-medium text-gray-700">Buscar Departamento</label>
                                <div class="relative mt-1">
                                    <input type="text" id="departamento_search" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50]" placeholder="Escribe el nombre del departamento..." autocomplete="off">
                                    <!-- Lista desplegable con sugerencias -->
                                    <ul id="departamento_suggestions" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden max-h-60 overflow-y-auto">
                                        <!-- Las sugerencias se insertarán aquí mediante JavaScript -->
                                    </ul>
                                </div>
                                <input type="hidden" id="selected_departamento" name="departamento_id">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('departamento_search');
        const suggestionsList = document.getElementById('departamento_suggestions');
        const selectedDepartamentoInput = document.getElementById('selected_departamento');
        
        searchInput.addEventListener('input', function() {
            const query = searchInput.value;
            
            if (query.length > 2) {
                fetch(`/search-departamentos?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsList.innerHTML = '';
                    if (data.length > 0) {
                        suggestionsList.classList.remove('hidden');
                        data.forEach(departamento => {
                            const li = document.createElement('li');
                            li.textContent = departamento.nombre_departamento;
                            li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                            li.addEventListener('click', function() {
                                searchInput.value = departamento.nombre_departamento;
                                selectedDepartamentoInput.value = departamento.id_departamento;
                                suggestionsList.classList.add('hidden');
                            });
                            suggestionsList.appendChild(li);
                        });
                    } else {
                        suggestionsList.classList.add('hidden');
                    }
                });
            } else {
                suggestionsList.classList.add('hidden');
            }
        });
        
        document.addEventListener('click', function(event) {
            if (!searchInput.contains(event.target) && !suggestionsList.contains(event.target)) {
                suggestionsList.classList.add('hidden');
            }
        });
    });
</script>
@endsection
