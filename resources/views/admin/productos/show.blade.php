@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">Detalles del Producto</h2>
                
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Información del Producto</h3>
                    <p><strong>ID:</strong> {{ $producto->id_producto }}</p>
                    <p><strong>Nombre:</strong> {{ $producto->nombre_producto }}</p>
                    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                    <p><strong>Imagen:</strong></p>
                    @if($producto->ruta_imagen)
                        <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="w-32 h-32 object-cover">
                    @else
                        <span class="text-gray-500">No disponible</span>
                    @endif
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-2">Proveedores</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Proveedor
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Stock
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($producto->proveedores as $proveedor)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $proveedor->nombre_proveedor }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $proveedor->pivot->precio }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $proveedor->pivot->stock }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.productos.index') }}" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                        Volver a la lista de productos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
