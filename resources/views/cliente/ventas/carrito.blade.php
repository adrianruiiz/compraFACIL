@extends('layouts.app')
@section('content')
<div class="bg-gray-100 py-6">
    <div class="container mx-auto">
        <!-- Carrito -->
        <div class="flex flex-wrap">
            <div class="w-full lg:w-3/4 px-4">
                <!-- Despues de agregar o eliminar -->
                @if (session('success'))
                <div id="alert-3" class="flex items-center p-4 mb-4 rounded-lg bg-green-50 bg-green-500 text-white" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                </div>
                @endif
                <div class="bg-white p-6 rounded-lg border border-gray-200 overflow-y-auto max-h-96">
                    <h2 class="text-2xl font-bold">Mi carrito ({{ count($carrito) }})</h2>
                    @foreach($carrito as $productoId => $item)
                    <div class="flex border-b py-4">
                        <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" class="w-20 h-20 object-cover rounded-md mr-4">
                        <div class="flex-grow">
                            <h3 class="text-xl font-semibold">{{ $item['nombre'] }} {{$item['stock']}} </h3>
                            <h3 class="text-md text-gray-400 font-semibold">{{ $item['nombre_proveedor'] }} </h3>
                            <p class="text-gray-700">{{ $item['descripcion'] }}</p>
                            <div class="flex items-center mt-2">
                                <form action="{{ route('cliente.carrito.eliminar') }}" method="POST" class="mr-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $productoId }}">
                                    <button type="submit" class="text-red-600 border border-gray-200 rounded-md px-2">Remover</button>
                                </form>
                                {{-- <span class="px-5"><button class="text-blue-800 border border-gray-200 rounded-md px-5">Guardar</button></span> --}}
                            </div>
                        </div>
                        <div class="flex flex-col justify-between">
                            <span class="text-xl font-bold precio">${{ number_format($item['precio'], 2) }}</span>
                            <input type="hidden" name="producto_id" value="{{ $productoId }}">
                            <input type="number" class="ml-4 border rounded-md cantidad" name="cantidad" data-precio="{{ $item['precio'] }}" value="{{ $item['cantidad'] }}" min="1" max="{{ $item['stock'] }}">
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{route('cliente.ventas.listado_productos')}}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Regresar a la tienda</a>
                        <button class="text-red-500 border border-gray-200 rounded-md p-1 px-2">Eliminar productos</button>
                    </div>
                </div>
                
            </div>
            <div class="w-full lg:w-1/4 px-4">
                <div class="bg-white p-4 rounded-md border border-gray-200">
                    <h2 class="text-2xl font-bold">¿Tienes un cupón?</h2>
                    <p class="flex items-center text-sm text-gray-500 dark:text-gray-400">Acerca de los cupones <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button></p>
                    <div data-popover id="popover-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Cupón</h3>
                            <p>Usa COMPRAFACIL para un 20% de descuento</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                    
                    <div class="flex mt-3">
                        <input type="text" id="cupon" class="border border-gray-200 rounded-l-md p-2 flex-grow" placeholder="Agregar cupón">
                        <button id="aplicar-cupon" class="text-blue-600 px-2 border border-gray-200 rounded-r-md">Aplicar</button>
                    </div>
                </div>
                <br>
                <form action="{{ route('cliente.carrito.pedidos.store') }}" method="POST">
                    @csrf
                    <!-- Agrega aquí los campos necesarios para el pedido -->
                    @foreach($carrito as $productoId => $item)
                    <input type="hidden" name="productos[{{ $productoId }}][id]" value="{{ $productoId }}">
                    <input type="hidden" name="productos[{{ $productoId }}][nombre]" value="{{ $item['nombre'] }}">
                    <input type="hidden" name="productos[{{ $productoId }}][cantidad]" value="{{ $item['cantidad'] }}">
                    <input type="hidden" name="productos[{{ $productoId }}][precio]" value="{{ $item['precio'] }}">
                    @endforeach
                    <div class="bg-white p-6 rounded-md border border-gray-200">
                        <div class="">
                            <div class="flex justify-between text-lg">
                                <span>Subtotal:</span>
                                <span id="subtotal" class="font-semibold">$1403.97</span>
                                <input type="hidden" name="subtotal" id="hidden-subtotal" value="$1403.97">
                            </div>
                            <div class="flex justify-between text-lg">
                                <span>Descuento:</span>
                                <span id="descuento" class="font-semibold text-red-500">-$60.00</span>
                                <input type="hidden" name="descuento" id="hidden-descuento" value="60.00">
                            </div>
                            <div class="flex justify-between text-lg">
                                <span>IVA:</span>
                                <span id="iva" class="font-semibold text-green-600">+$14.00</span>
                                <input type="hidden" name="iva" id="hidden-iva" value="14.00">
                            </div>
                            <br>
                            <hr class="py-1">
                            <div class="flex justify-between text-2xl font-bold mt-4">
                                <span>Total:</span>
                                <span id="total">$1357.97</span>
                                <input type="hidden" name="total" id="hidden-total" value="$1357.97">
                            </div>
                            <input type="hidden" name="id_cliente" value="{{ auth()->user()->id}}">
                            <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded-md w-full">Realizar Pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full px-4">
            <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Recomendaciones</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($guardadosParaMasTarde as $item)
                    <div class="p-4 flex flex-col justify-between h-full">
                        <div>
                            <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" class="w-32 h-32 object-cover rounded-md mb-4 ">
                            <span class="text-xl font-bold text-green-600">${{ number_format($item['precio'], 2) }}</span>
                            <h3 class="text-lg font-semibold">{{ $item['nombre'] }}</h3>
                        </div>
                        <button class="mt-2 border border-gray-200 text-blue-600 font-semibold px-4 py-2 rounded-md flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            <span>Añadir al carrito</span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 bg-blue-600 text-white p-4 rounded-md text-center">
            <h3 class="text-xl font-bold">Descuentooooo</h3>
            <p>Más info aquí</p>
            <button class="mt-2 bg-orange-500 px-4 py-2 rounded-md">Comprar</button>
        </div>
    </div>
</div>

<br>
<br>
<br>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Manejo de la actualización de cantidad
        document.querySelectorAll('select[name="cantidad"]').forEach(select => {
            select.addEventListener('change', function () {
                const cantidad = this.value;
                const itemId = this.closest('.border-b').querySelector('input[name="producto_id"]').value;
                
                // Envía una solicitud para actualizar la cantidad en el carrito
                fetch('/carrito/actualizar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: itemId,
                        cantidad: cantidad,
                        stock: nuevoStock
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recarga la página para reflejar los cambios
                    } else {
                        alert('Error al actualizar la cantidad.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
        
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
        
        
        // Manejo de la eliminación de productos
        document.querySelectorAll('button.text-red-600').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.closest('.border-b').querySelector('input[name="producto_id"]').value;
                
                // Envía una solicitud para eliminar el producto del carrito
                fetch('/carrito/eliminar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: itemId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recarga la página para reflejar los cambios
                    } else {
                        alert('Error al eliminar el producto.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>

{{-- calculo totales --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cantidadInputs = document.querySelectorAll('input[name="cantidad"]');
        const cuponInput = document.getElementById('cupon');
        const aplicarCuponBtn = document.getElementById('aplicar-cupon');
        const subtotalElement = document.getElementById('subtotal');
        const descuentoElement = document.getElementById('descuento');
        const ivaElement = document.getElementById('iva');
        const totalElement = document.getElementById('total');
        
        const hiddenSubtotal = document.getElementById('hidden-subtotal');
        const hiddenDescuento = document.getElementById('hidden-descuento');
        const hiddenIva = document.getElementById('hidden-iva');
        const hiddenTotal = document.getElementById('hidden-total');
        
        let iva = 0.16; // 16% IVA
        let descuento = 0;
        
        function updateCartSummary() {
            let subtotal = 0;
            cantidadInputs.forEach(input => {
                const precio = parseFloat(input.dataset.precio);
                const cantidad = parseInt(input.value);
                subtotal += precio * cantidad;
            });
            
            let ivaValue = subtotal * iva;
            let total = subtotal - descuento + ivaValue;
            
            subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
            descuentoElement.textContent = `-$${descuento.toFixed(2)}`;
            ivaElement.textContent = `+$${ivaValue.toFixed(2)}`;
            totalElement.textContent = `$${total.toFixed(2)}`;
            
            // Actualiza los campos ocultos
            hiddenSubtotal.value = subtotal.toFixed(2);
            hiddenDescuento.value = descuento.toFixed(2);
            hiddenIva.value = ivaValue.toFixed(2);
            hiddenTotal.value = total.toFixed(2);
        }
        
        cantidadInputs.forEach(input => {
            input.addEventListener('input', function (event) {
                const max = parseInt(event.target.max);
                const value = parseInt(event.target.value);
                
                if (value > max) {
                    event.target.value = max;
                } else if (value < 1) {
                    event.target.value = 1;
                }
                
                updateCartSummary();
            });
        });
        
        aplicarCuponBtn.addEventListener('click', function () {
            const cupon = cuponInput.value.trim().toUpperCase();
            
            // Lógica para aplicar el descuento basado en el cupón
            if (cupon === 'COMPRAFACIL') {
                descuento = 0.20 * parseFloat(subtotalElement.textContent.replace('$', ''));
            } else {
                descuento = 0;
            }
            
            updateCartSummary();
        });
        
        updateCartSummary();
    });
</script>

@endsection
