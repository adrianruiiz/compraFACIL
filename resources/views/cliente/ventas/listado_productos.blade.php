{{-- cliente.ventas.listado_productos --}}
@extends('layouts.app')
@section('content')
<div class="bg-gray-100 py-6">
    <div class="container mx-auto">
        <div class="flex flex-wrap">
            <!-- Sidebar de categorías y filtros -->
            <aside class="w-full md:w-1/4 px-4">
                <div class="bg-white p-4 rounded-lg ">
                    <p class="text-gray-500">Tienda > Productos > Categoria</p>
                    <hr class="py-2">
                    <!-- Campo de búsqueda -->
                    <div class="mb-4">
                        <input id="searchInput" type="text" placeholder="Buscar productos..." class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <h2 class="text-xl font-bold mb-4">Categorías</h2>
                    <ul class="space-y-2 mb-6">
                        @foreach ($categorias as $categoria)
                        <li>
                            <a href="{{ route('cliente.ventas.listado_productos', ['categoria' => $categoria->id_categoria]) }}"
                                class="text-gray-700 hover:text-blue-500 {{ request('categoria') == $categoria->id_categoria ? 'font-bold' : '' }}">
                                {{ $categoria->nombre_categoria }}
                            </a>
                        </li>
                        @endforeach
                        <li><a href="{{ route('cliente.ventas.listado_productos') }}" class="text-blue-700 hover:text-blue-500">Ver todos</a></li>
                    </ul>
                    
                    <hr class="py-2">
                    
                    <h2 class="text-xl font-bold mb-4">Marcas</h2>
                    
                    <ul class="space-y-2 mb-6">
                        @foreach ($marcas as $brand)
                        <li>
                            <input type="checkbox" class="mr-2" name="marcas[]" value="{{ $brand }}">
                            {{ $brand }}
                        </li>
                        @endforeach
                        <!-- Botón para limpiar filtros -->
                        <button id="clearFiltersButton" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            Limpiar Filtros
                        </button>
                    </ul>
                    
                </div>
            </aside>
            
            <!-- Lista de productos -->
            <main class="w-full md:w-3/4 px-4">
                <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">
                        {{ $categoria_nombre }} ({{$productos->total()}})
                    </h2>
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        {{-- este boton es para mostrar varios por fila --}}
                        <button id="gridViewButton" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>                          
                        </button>
                        {{-- este boton es para mostrar 1 por fila --}}
                        <button id="listViewButton" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
                <br>
                <!-- Mensaje si no hay productos -->
                @if($productos->isEmpty())
                <div class="bg-white p-4 rounded-lg shadow mb-6">
                    <p class="text-gray-700">No hay productos disponibles para la categoría "{{ $categoria_nombre }}".</p>
                </div>
                @else
                <div id="productGrid" class="grid grid-cols-1 gap-6">
                    @foreach($productos as $producto)
                    <div class="product-card flex flex-col md:flex-row border rounded-lg p-4 bg-white" data-brand="{{ $producto->marca }}">
                        <img src="{{ $producto->ruta_imagen }}" alt="{{ $producto->nombre_producto }}" class="product-image w-full md:w-32 h-32 object-cover rounded-md mr-4">
                        <div class="product-info">
                            <h3 class="product-name text-xl font-semibold">{{ $producto->nombre_producto }}</h3>
                            @foreach ($producto->proveedores as $proveedor)
                            <span class="product-price text-xl font-bold text-green-600">Desde ${{ number_format($proveedor->pivot->precio, 2) }}</span>
                            @endforeach
                            <span class="line-through text-gray-500 ml-2">${{ number_format($proveedor->pivot->precio + 20, 2) }}</span>
                            <div class="flex items-center mt-2">
                                <span class="product-rating text-yellow-500">★★★★☆</span>
                                <span class="text-green-600 ml-2">Envío gratis</span>
                            </div>
                            <p class="product-description text-gray-700 mb-2 py-2">{{ $producto->descripcion }}</p>
                            <a href="{{ route('cliente.ventas.detalle_producto', ['id' => $producto->id_producto]) }}" class="text-blue-500 hover:underline mt-2 block">Ver producto</a>
                        </div>
                    </div>
                    @endforeach
                </div>                
                @endif
                
                <!-- Paginación -->
                <div class="mt-6 bg-white rounded border py-1 px-2">
                    {{ $productos->links('pagination.custom') }}
                </div>
                
            </main>
        </div>
    </div>
</div>
<br><br><br><br>



<script>
    let isGridView = false;
    
    document.getElementById('gridViewButton').addEventListener('click', function() {
        const productGrid = document.getElementById('productGrid');
        const productCards = document.querySelectorAll('.product-card');
        const productImages = document.querySelectorAll('.product-image');
        const productInfos = document.querySelectorAll('.product-info');
        const productNames = document.querySelectorAll('.product-name');
        const productPrices = document.querySelectorAll('.product-price');
        const productDescriptions = document.querySelectorAll('.product-description');
        const productRatings = document.querySelectorAll('.product-rating');
        
        isGridView = true;
        
        // Cambiar a vista de cuadrícula
        productGrid.classList.remove('grid-cols-1');
        productGrid.classList.add('grid-cols-4');
        
        productCards.forEach(card => card.classList.add('grid-view-card'));
        productImages.forEach(image => image.classList.add('grid-view-image'));
        productInfos.forEach(info => info.classList.add('grid-view-info'));
        productNames.forEach(name => name.classList.add('grid-view-name'));
        productPrices.forEach(price => price.classList.add('grid-view-price'));
        productDescriptions.forEach(description => description.classList.add('grid-view-description'));
        productRatings.forEach(rating => rating.classList.add('hidden'));
        productDescriptions.forEach(description => description.classList.add('hidden'));
    });
    
    document.getElementById('listViewButton').addEventListener('click', function() {
        const productGrid = document.getElementById('productGrid');
        const productCards = document.querySelectorAll('.product-card');
        const productImages = document.querySelectorAll('.product-image');
        const productInfos = document.querySelectorAll('.product-info');
        const productNames = document.querySelectorAll('.product-name');
        const productPrices = document.querySelectorAll('.product-price');
        const productDescriptions = document.querySelectorAll('.product-description');
        const productRatings = document.querySelectorAll('.product-rating');
        
        isGridView = false;
        
        // Cambiar a vista de lista
        productGrid.classList.remove('grid-cols-4');
        productGrid.classList.add('grid-cols-1');
        
        productCards.forEach(card => card.classList.remove('grid-view-card'));
        productImages.forEach(image => image.classList.remove('grid-view-image'));
        productInfos.forEach(info => info.classList.remove('grid-view-info'));
        productNames.forEach(name => name.classList.remove('grid-view-name'));
        productPrices.forEach(price => price.classList.remove('grid-view-price'));
        productDescriptions.forEach(description => description.classList.remove('grid-view-description'));
        productRatings.forEach(rating => rating.classList.remove('hidden'));
        productDescriptions.forEach(description => description.classList.remove('hidden'));
    });
    
    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[name="marcas[]"]');
        const products = document.querySelectorAll('.product-card');
        const searchInput = document.getElementById('searchInput');
        
        // Cargar marcas seleccionadas desde localStorage
        const savedBrands = JSON.parse(localStorage.getItem('selectedBrands')) || [];
        checkboxes.forEach(checkbox => {
            if (savedBrands.includes(checkbox.value.trim())) {
                checkbox.checked = true;
            }
        });
        
        // Aplicar filtro de productos
        filterProducts(savedBrands);
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectedBrands = Array.from(checkboxes)
                .filter(i => i.checked)
                .map(i => i.value.trim()); // Trim to remove extra spaces
                
                localStorage.setItem('selectedBrands', JSON.stringify(selectedBrands)); // Guardar marcas seleccionadas
                
                filterProducts(selectedBrands);
            });
        });
        
        function filterProducts(selectedBrands) {
            const searchText = searchInput.value.trim().toLowerCase();
            products.forEach(product => {
                const productBrand = product.getAttribute('data-brand').trim().toLowerCase();
                const productName = product.querySelector('.product-name').textContent.toLowerCase();
                
                const matchesBrand = selectedBrands.length === 0 || selectedBrands.includes(productBrand);
                const matchesSearch = productName.includes(searchText);
                
                if (matchesBrand && matchesSearch) {
                    product.style.display = 'flex'; // Mostrar producto
                } else {
                    product.style.display = 'none'; // Ocultar producto
                }
            });
        }
        
        // Event listener para la búsqueda en tiempo real
        searchInput.addEventListener('input', function() {
            filterProducts(Array.from(checkboxes)
            .filter(i => i.checked)
            .map(i => i.value.trim()));
        });
        
        // Limpiar filtros
        document.querySelector('#clearFiltersButton').addEventListener('click', function() {
            localStorage.removeItem('selectedBrands'); // Eliminar marcas seleccionadas del almacenamiento
            checkboxes.forEach(checkbox => checkbox.checked = false); // Desmarcar todas las casillas
            searchInput.value = ''; // Limpiar campo de búsqueda
            filterProducts([]); // Mostrar todos los productos
        });
    });
    
</script>

<style>
    .grid-view-card {
        flex-direction: column;
        text-align: center;
    }
    .grid-view-image {
        width: 100%;
        height: auto;
    }
    .grid-view-info {
        margin-top: 1rem;
    }
    .grid-view-name,
    .grid-view-price,
    .grid-view-description {
        text-align: center;
    }
</style>

@endsection
