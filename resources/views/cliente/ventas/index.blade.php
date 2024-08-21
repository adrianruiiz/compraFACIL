@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Sección de Departamentos y Contenido Principal -->
        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 border border-gray-200 rounded-lg">
            <!-- Columna de Departamentos -->
            <div class="w-full md:w-1/4 bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">Departamentos</h2>
                    <ul class="space-y-3">
                        @foreach($departamentos as $departamento)
                        <li class="relative">
                            <button 
                            class="text-gray-700 hover:text-[#4CAF50] cursor-pointer transition-colors duration-300 flex items-center w-full justify-between" 
                            onclick="toggleCategories('{{ $departamento->id_departamento }}')"
                            >
                            <span class="font-semibold">{{ $departamento->nombre_departamento }}</span>
                            <svg 
                            class="w-5 h-5 ml-2 text-gray-500 transition-transform duration-300" 
                            id="icon-{{ $departamento->id_departamento }}" 
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 24 24" 
                            fill="currentColor"
                            >
                            <path d="M12 15.88l-4.29-4.3a1 1 0 0 1 1.41-1.41L12 13.08l2.88-2.88a1 1 0 0 1 1.41 1.41L12 15.88z"/>
                        </svg>
                    </button>
                    <div 
                    id="categories-{{ $departamento->id_departamento }}" 
                    class="overflow-hidden max-h-0 transition-max-height duration-500 ease-in-out"
                    >
                    <ul class="py-2 space-y-2">
                        @foreach($departamento->categorias as $categoria)
                        <li class="px-4 py-2 text-gray-700 hover:bg-[#F1F8E9] transition-colors duration-300">
                            {{ $categoria->nombre_categoria }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Columna de Imagen Principal y Novedades -->
<div class="w-full md:w-2/4 bg-white rounded-lg shadow-md">
    <div class="p-6">
        <div class="relative mb-6">
            {{-- <img src="/images/frutas.png" alt="Imagen destacada" class="w-full h-64 object-cover rounded-lg shadow-md"> --}}
            <img src="https://media.gettyimages.com/id/109908841/es/foto/a-tray-full-of-granny-smiths.jpg?s=612x612&w=0&k=20&c=cVEgh17CwSwJJUAaADiRRik1EdDWq1FghK_-VuDlVow=" alt="Imagen destacada" class="w-full h-64 object-cover rounded-lg shadow-md">
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black via-transparent to-transparent p-4 text-white">
                <h3 class="text-xl font-bold">¡Nuevas Frutas Frescas!</h3>
                <p>Descubre las frutas más frescas y deliciosas en nuestra tienda.</p>
            </div>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Novedades y Recomendaciones</h2>
            <div class="space-y-4">
                <!-- Novedad 1 -->
                <div class="bg-[#F1F8E9] p-4 rounded-md shadow-md transition-transform transform hover:scale-105 duration-300">
                    <h3 class="text-lg font-semibold text-[#4CAF50]">Nuevo Producto en Oferta</h3>
                    <p class="text-gray-700">Descubre el nuevo producto que acaba de llegar a nuestra tienda. ¡No te lo pierdas!</p>
                </div>
                <!-- Novedad 2 -->
                <div class="bg-[#E1F5FE] p-4 rounded-md shadow-md transition-transform transform hover:scale-105 duration-300">
                    <h3 class="text-lg font-semibold text-[#1E88E5]">Producto Recomendado del Mes</h3>
                    <p class="text-gray-700">Este producto ha sido seleccionado especialmente para ti. ¡Echa un vistazo a nuestras recomendaciones!</p>
                </div>
                <!-- Botón para ver más -->
                <div class="text-center mt-4">
                    <a href="{{ route('cliente.ventas.listado_productos') }}" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded-lg hover:bg-[#45A049] transition duration-150 transform hover:scale-105">
                        Ver Más Novedades
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Columna de Ofertas y Productos -->
<div class="w-full md:w-1/4 bg-white rounded-lg shadow-md">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Ofertas Especiales</h2>
        <div class="space-y-4">
            <div class="bg-[#F9FBE7] p-4 rounded-md shadow-md transition-transform transform hover:scale-105 duration-300">
                <h3 class="text-lg font-semibold text-[#4CAF50]">Descuento del 20%</h3>
                <p class="text-gray-700">¡Aprovecha un 20% de descuento en todos los productos de verano!</p>
            </div>
            <div class="bg-[#E8F5E9] p-4 rounded-md shadow-md transition-transform transform hover:scale-105 duration-300">
                <h3 class="text-lg font-semibold text-[#388E3C]">Compra 1, Lleva 2</h3>
                <p class="text-gray-700">Compra un producto y recibe otro igual gratis. Solo por tiempo limitado.</p>
            </div>
            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Tiempo Restante:</h4>
                <div id="countdown" class="text-xl font-bold text-[#4CAF50]">
                    <span id="timer">00:00:00</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<br>

<!-- Sección de Productos -->
<div class="bg-white overflow-hidden border border-gray-300 rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Productos Destacados</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productos as $producto)
        <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200 transition-transform transform hover:scale-105 duration-300 flex flex-col h-full min-h-[300px]">
            <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="w-full h-40 object-cover rounded-md mb-2">
            <h2 class="text-md font-semibold mb-2 text-gray-800">{{ $producto->nombre_producto }}</h2>
            
            @if($producto->proveedores->isNotEmpty())
            @php
            $precioMinimo = $producto->proveedores->min('pivot.precio');
            @endphp
            <span class="product-price text-xl font-bold text-green-600">
                Desde ${{ number_format($precioMinimo, 2) }}
            </span>
            @endif
            
            <div class="mt-auto">
                <a href="{{ route('cliente.ventas.detalle_producto', ['id' => $producto->id_producto]) }}" class="w-full border border-gray-200 text-blue-600 font-semibold px-4 py-2 rounded-md flex items-center justify-center space-x-2 hover:text-blue-800">Ver producto</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Sección de Ofertas Relacionadas -->
<div class="bg-white mt-8 overflow-hidden border border-gray-300 rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Ofertas Relacionadas</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-[#F5F5F5] shadow-md rounded-lg p-4 border border-gray-200 transition-transform transform hover:scale-105 duration-300">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">Oferta Especial</h3>
            <p class="text-gray-700 mb-2">Aquí irá la descripción de la oferta especial.</p>
            <span class="block text-xl font-bold text-[#FF5722]">$12</span>
        </div>
    </div>
</div>

</div>
</div>
<br>
@section('scripts')
<script>
    // Función para alternar la visibilidad de las categorías
    function toggleCategories(departmentId) {
        const categoriesDiv = document.getElementById(`categories-${departmentId}`);
        const icon = document.getElementById(`icon-${departmentId}`);
        
        if (categoriesDiv.classList.contains('max-h-0')) {
            categoriesDiv.classList.remove('max-h-0');
            categoriesDiv.classList.add('max-h-screen');
            icon.style.transform = 'rotate(180deg)';
        } else {
            categoriesDiv.classList.remove('max-h-screen');
            categoriesDiv.classList.add('max-h-0');
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>
@endsection
@endsection
