@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Mensajes -->
        @if (session('success'))
        <div class="alert bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ session('error') }}
        </div>
        @endif
        
        
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('admin.departamentos.create') }}" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150 mb-4">
                    Agregar Departamento
                </a>
                <h2 class="text-2xl font-bold mb-4">Administración de Departamentos</h2>
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
                                    Categorías
                                </th>
                                <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($departamentos as $departamento)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $departamento->id_departamento }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $departamento->nombre_departamento }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <ul>
                                        @foreach($departamento->categorias as $categoria)
                                        <li>{{ $categoria->nombre_categoria }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <a href="{{ route('admin.departamentos.edit', $departamento->id_departamento) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                    <form action="{{ route('admin.departamentos.destroy', $departamento->id_departamento) }}" method="POST" class="inline-block">
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
                                        No hay departamentos
                                    </span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mt-4">
                    {{ $departamentos->links() }} <!-- Paginación -->
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todas las alertas en la página
        const alerts = document.querySelectorAll('.alert');
        
        alerts.forEach(function(alert) {
            // Después de 3 segundos (3000 milisegundos), oculta la alerta
            setTimeout(function() {
                alert.style.opacity = '0'; // Transición de opacidad para un efecto de desvanecimiento
                alert.style.transition = 'opacity 0.5s'; // Opcional: Añade una transición para que el desvanecimiento sea suave
                setTimeout(function() {
                    alert.style.display = 'none'; // Oculta el elemento completamente después de la transición
                }, 500); // Tiempo de transición
            }, 3000); // Tiempo en milisegundos antes de comenzar el desvanecimiento
        });
    });
</script>
@endsection

