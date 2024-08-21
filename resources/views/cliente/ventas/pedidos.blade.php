@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-6">
    <div class="container mx-auto">
        <!-- Pedidos -->
        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/4 px-4">
                <div class="bg-white p-4 rounded-md border border-gray-200">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-bold">Busca tu pedido</h2>
                        <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button">
                            <svg class="w-4 h-4 ms-2 text-gray-400 hover:text-green-500 ml-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only"></span>
                        </button>
                        <div data-popover id="popover-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-white transition-opacity duration-300 bg-green-500 border border-green-400 rounded-lg shadow-sm opacity-0 w-72">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-white">USA EL CÓDIGO DEL PEDIDO</h3>
                                <p>Utiliza el código de tu pedido para encontrarlo fácilmente</p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>                    
                    
                    <div class="flex mt-3">
                        <input type="text" id="codigo_pedido" class="border border-gray-200 rounded-l-md p-2 flex-grow" placeholder="Agrega el código">
                        <button id="codigo-pedido" class="text-blue-600 px-2 border border-gray-200 rounded-r-md">Buscar</button>
                    </div>
                </div>
                <br>
                <div class="bg-white p-4 rounded-md border border-gray-200">
                    <h2 class="text-2xl font-bold">Tickets</h2>
                    <ul class="space-y-2">
                        @foreach($pedidosRealizados as $pedido)
                        <li class="flex items-center justify-between p-2 rounded-md">
                            <span class="text-lg">{{ $pedido->codigo_pedido }}</span>
                            <a href="{{ route('cliente.pedido.pdf', $pedido->id_pedido) }}" target="_blank">
                                <svg class="w-6 h-6 text-red-400 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>                
            </div>
            <div id="pedidos-container" class="w-full lg:w-3/4 px-4">
                <div class="bg-white p-4 rounded-lg border border-gray-200 relative">
                    <!-- Dropdown Button -->
                    <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="absolute right-2 text-gray-800 bg-transparent border-none cursor-pointer">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 4v10m0 0a2 2 0 1 0 0 4m0-4a2 2 0 1 1 0 4m0 0v2m6-16v2m0 0a2 2 0 1 0 0 4m0-4a2 2 0 1 1 0 4m0 0v10m6-16v10m0 0a2 2 0 1 0 0 4m0-4a2 2 0 1 1 0 4m0 0v2"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="dropdownBgHover" class="z-10 hidden absolute right-2 top-12 w-48 bg-white rounded-lg shadow">
                        <ul class="p-3 space-y-1 text-sm text-gray-700">
                            <li>
                                <a href="#" class="filter-item p-2 flex items-center rounded hover:bg-gray-100" data-filter="todos">Todos</a>
                            </li>
                            <li>
                                <a href="#" class="filter-item p-2 flex items-center rounded hover:bg-gray-100" data-filter="Proceso">En Proceso</a>
                            </li>
                            <li>
                                <a href="#" class="filter-item p-2 flex items-center rounded hover:bg-gray-100" data-filter="Realizado">Realizados</a>
                            </li>
                        </ul>
                    </div>
                    
                    <h2 id="pedidos-title" class="text-2xl font-bold">Pedidos</h2>
                    <hr>
                    <div id="no-results-message" class="text-gray-500 text-center hidden">No se encontraron pedidos.</div>
                    <div id="pedidos-list">
                        @foreach($pedidos as $pedido)
                        <div class="pedido-item flex border-b py-4" data-codigo="{{ $pedido->codigo_pedido }}" data-estado="{{ $pedido->estado }}">
                            <div class="flex-grow">
                                <div class="flex items-center mt-2">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        #{{ $pedido->codigo_pedido }}
                                    </h3>
                                    <p class="text-sm text-gray-500 ml-4">
                                        Estado: {{ $pedido->estado }}
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600">
                                    Fecha: {{ $pedido->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="flex flex-col justify-between">
                                <button onclick="openSidebar({{ $pedido->id_pedido }})" class="text-green-500 hover:underline">Ver Detalles</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar para los detalles del pedido -->
    <div id="sidebar" class="fixed z-50 inset-y-0 right-0 bg-gray-100 text-green-900 w-120 max-w-full shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
        <div class="flex-1 flex flex-col h-full">
            <div id="sidebar-content" class="flex-1 overflow-y-auto p-4">
                <!-- Aquí se cargan los detalles del pedido con AJAX -->
            </div>
        </div>
    </div>
    
    
    <!-- Sidebar de Pago (Oculto por defecto) -->
    <div id="paymentSidebar" class="fixed z-50 inset-y-0 right-0 bg-gray-900 text-white w-120 max-w-full shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out hidden">
        <div class="p-6">
            <div class="space-y-4">
                <!-- Contenido del sidebar de pago aquí -->
            </div>
        </div>
    </div>
    
</div>


<!-- NOTIFICACIÓN DE PEDIDO REALIZADO -->
<div id="toast-interactive" class="fixed top-5 right-5 w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow hidden" role="alert">
    <div class="flex">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-6 h-6 text-green-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
            </svg>              
            <span class="sr-only">Notification icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">
            <span class="mb-1 text-sm font-semibold text-gray-900">{{ session('success.message') }}</span>
            <div class="mb-2 text-sm font-normal">Tu pedido ha sido realizado.</div>
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
<br>
<br>
<br>
<br>

<script>
    // Toggle the dropdown menu visibility
    document.getElementById('dropdownBgHoverButton').addEventListener('click', function() {
        document.getElementById('dropdownBgHover').classList.toggle('hidden');
    });
    
    // Handle filter item clicks
    document.querySelectorAll('.filter-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');
            filterPedidos(filter);
            updateTitle(filter);
        });
    });
    
    // Function to filter pedidos
    function filterPedidos(filter) {
        const items = document.querySelectorAll('.pedido-item');
        let hasVisibleItems = false;
        
        items.forEach(item => {
            const estado = item.getAttribute('data-estado');
            if (filter === 'todos' || estado === filter) {
                item.classList.remove('hidden');
                hasVisibleItems = true;
            } else {
                item.classList.add('hidden');
            }
        });
        
        document.getElementById('no-results-message').classList.toggle('hidden', hasVisibleItems);
    }
    
    // Function to update the title based on the selected filter
    function updateTitle(filter) {
        const title = document.getElementById('pedidos-title');
        switch (filter) {
            case 'todos':
            title.textContent = 'Todos los Pedidos';
            break;
            case 'Proceso':
            title.textContent = 'Pedidos en Proceso';
            break;
            case 'Realizado':
            title.textContent = 'Pedidos Realizados';
            break;
            default:
            title.textContent = 'Pedidos';
            break;
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén referencias a los elementos
        const searchInput = document.getElementById('codigo_pedido');
        const pedidosContainer = document.getElementById('pedidos-container');
        const noResultsMessage = document.getElementById('no-results-message');
        
        // Función para filtrar pedidos
        function filterPedidos() {
            const searchTerm = searchInput.value.toLowerCase();
            const pedidos = pedidosContainer.querySelectorAll('.pedido-item');
            let resultsFound = false;
            
            pedidos.forEach(pedido => {
                const codigo = pedido.getAttribute('data-codigo').toLowerCase();
                if (codigo.includes(searchTerm)) {
                    pedido.style.display = '';
                    resultsFound = true;
                } else {
                    pedido.style.display = 'none';
                }
            });
            
            // Mostrar el mensaje si no se encontraron resultados
            if (resultsFound) {
                noResultsMessage.classList.add('hidden');
            } else {
                noResultsMessage.classList.remove('hidden');
            }
        }
        
        // Agrega el evento de entrada al campo de búsqueda
        searchInput.addEventListener('input', filterPedidos);
    });
</script>



<script>
    function openSidebar(pedidoId) {
        fetch(`detalles_pedido/${pedidoId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('sidebar-content').innerHTML = html;
            document.getElementById('sidebar').classList.remove('translate-x-full');
            document.getElementById('sidebar').classList.add('translate-x-0');
        })
        .catch(error => console.error('Error:', error));
    }
    
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('translate-x-full');
        document.getElementById('sidebar').classList.remove('translate-x-0');
    }
    
    function openPaymentSidebar() {
        // Mueve el primer sidebar a la izquierda
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar').classList.remove('translate-x-0');
        
        const paymentSidebar = document.getElementById('paymentSidebar');
        paymentSidebar.classList.remove('hidden');
    }
    
    
    function closePaymentSidebar() {
        const paymentSidebar = document.getElementById('paymentSidebar');
        
        // Mueve el sidebar de pagos fuera de la vista
        paymentSidebar.classList.add('translate-x-full');
        paymentSidebar.classList.remove('translate-x-0');
        
        // Una vez que el sidebar está fuera de vista, ocultarlo
        paymentSidebar.addEventListener('transitionend', function() {
            if (paymentSidebar.classList.contains('translate-x-full')) {
                paymentSidebar.classList.add('hidden');
            }
        }, { once: true });
    }
    
</script>



@endsection
