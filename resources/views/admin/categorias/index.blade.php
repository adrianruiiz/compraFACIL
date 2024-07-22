@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Mensaje de éxito -->
        @if (session('success'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
          <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Info</span>
          <div class="ms-3 text-sm font-medium">
            {{ session('success') }}
          </div>
        </div>
        @endif

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{-- @include('admin.categorias.create') <!-- botón de Agregar Categoria --> --}}
                <a href="{{ route('admin.categorias.create') }}" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150 mb-4">
                    Agregar Categoría
                </a>
                <h2 class="text-2xl font-bold mb-4">Administración de Categorías</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Descripción
                                </th>
                                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categorias as $categoria)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $categoria->id_categoria }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $categoria->nombre_categoria }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $categoria->descripcion }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <a href="{{ route('admin.categorias.edit', $categoria->id_categoria) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                    <form action="{{ route('admin.categorias.destroy', $categoria->id_categoria) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-2 px-4 border-b border-gray-200 text-center">
                                    <span class="text-red-500 font-semibold">
                                        No hay categorías
                                    </span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mt-4">
                    {{ $categorias->links() }} <!-- Paginación -->
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script>
    // Espera a que el DOM se cargue completamente
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
@endsection
