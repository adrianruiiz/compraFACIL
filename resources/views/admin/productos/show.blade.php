@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">Detalles del Producto - {{ $producto->nombre_producto }}</h2>
                
                <div class="mb-4 flex items-center space-x-4">
                    @if($producto->ruta_imagen)
                    <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="w-32 h-32 object-cover">
                    @else
                    <span class="text-gray-500">No disponible</span>
                    @endif
                    <p class="text-gray-900">{{ $producto->descripcion }}</p>
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
                                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($producto->proveedores as $proveedor)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $proveedor->nombre_proveedor }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $proveedor->pivot->precio }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $proveedor->pivot->stock }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <button 
                                        data-id="{{ $proveedor->pivot->id_proveedor }}" 
                                        data-producto-id="{{ $producto->id_producto }}" 
                                        data-precio="{{ $proveedor->pivot->precio }}" 
                                        data-stock="{{ $proveedor->pivot->stock }}" 
                                        class="open-modal px-4 py-2  text-blue-500  hover:bg-blue-600 transition duration-150">
                                        Editar
                                    </button>
                                    <form action="{{ route('admin.productos.proveedores.destroy', [$producto->id_producto, $proveedor->pivot->id_proveedor]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-red-500 transition duration-150">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
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

<!-- Modal para editar precio y stock -->
<div id="edit-modal" class="fixed inset-0 flex items-center justify-center bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-lg font-semibold mb-4">Editar Producto</h3>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="proveedor_id" id="proveedor_id">
            <div class="mb-4">
                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" name="precio" id="precio" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" id="stock" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2  bg-[#4CAF50] text-white rounded hover:bg-blue-600 transition duration-150">Guardar</button>
                <button type="button" id="close-modal" class="ml-2 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-400 transition duration-150">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- toast -->
<div id="toast-interactive" class="fixed top-5 right-5 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow hidden" role="alert">
    <div class="flex">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
            </svg>              
            <span class="sr-only">Notification icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">
            <span class="mb-1 text-sm font-semibold text-gray-900">Hecho</span>
            <div class="mb-2 text-sm font-normal">{{ session('success.message') }}</div>
            <div class="grid grid-cols-2 gap-2">
            </div>    
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white items-center justify-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" data-dismiss-target="#toast-interactive" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('edit-modal');
        const openButtons = document.querySelectorAll('.open-modal');
        const closeButton = document.getElementById('close-modal');
        const form = document.getElementById('edit-form');
        
        // Maneja la apertura del modal
        openButtons.forEach(button => {
            button.addEventListener('click', function() {
                const proveedorId = this.getAttribute('data-id');
                const productoId = this.getAttribute('data-producto-id'); // Asegúrate de pasar el ID del producto
                const precio = this.getAttribute('data-precio');
                const stock = this.getAttribute('data-stock');
                
                document.getElementById('proveedor_id').value = proveedorId;
                document.getElementById('precio').value = precio;
                document.getElementById('stock').value = stock;
                
                // Configura la acción del formulario
                form.action = `/admin/productos/${productoId}/proveedores/${proveedorId}`; // Incluye el ID del producto en la URL
                
                // Muestra el modal
                modal.classList.remove('hidden');
            });
        });
        
        // Maneja el cierre del modal
        closeButton.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verificar si hay un mensaje de éxito en la sesión
        @if (session('success'))
        // Mostrar el toast
        document.getElementById('toast-interactive').classList.remove('hidden');
        
        // Ocultar el toast después de 5 segundos
        setTimeout(function () {
            document.getElementById('toast-interactive').classList.add('hidden');
        }, 5000);
        @endif
    });
</script>

@endsection
