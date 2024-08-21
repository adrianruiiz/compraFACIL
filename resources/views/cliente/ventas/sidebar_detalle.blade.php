@php
use Illuminate\Support\Str;
@endphp

<div class="space-y-4 flex flex-col h-full">
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-lg font-semibold text-green-600">Pedido #{{$pedido->codigo_pedido}}</h2>
        <button onclick="closeSidebar()" class="text-gray-600 hover:text-red-700 text-2xl w-12 h-12 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
              </svg>              
        </button>
    </div>
    <div class="flex border-b border-green-300">
        <div class="flex-1 px-4 flex items-center text-green-600">
            Producto
        </div>
        <div class="flex-1 px-4 py-2 text-right ml-6 text-green-600">
            #
        </div>
        <div class="flex-1 px-4 py-2 text-right text-green-600">
            Precio
        </div>
    </div>
    
    <!-- Contenedor con scroll para los productos -->
    <div class=" overflow-y-auto max-h-64">
        @foreach($pedido->detalles as $detalle)
        <div class="flex border-b border-green-200">
            <!-- Columna Producto -->
            <div class="w-1/2 px-4 py-2 flex items-center">
                <img src="{{ $detalle->producto->ruta_imagen }}" alt="{{ $detalle->producto->nombre_producto }}" class="w-12 h-12 object-cover rounded-md mr-3">
                <div>
                    <p class="text-sm font-medium truncate">{{ Str::limit($detalle->producto->nombre_producto, 20, '...') }}</p>
                    <p class="text-xs text-gray-500">${{ number_format($detalle->precio, 2) }}</p>
                </div>
            </div>
            <!-- Columna Cantidad -->
            <div class="w-1/4 px-4 ml-4 py-2 text-center">
                <span class="bg-green-700 text-white px-2 py-1 rounded-lg">{{ $detalle->cantidad }}</span>
            </div>
            <!-- Columna Precio -->
            <div class="w-1/4 px-4 py-2 text-right">
                <p class="text-sm font-semibold text-green-600">${{ number_format($detalle->precio * $detalle->cantidad, 2) }}</p>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Totales -->
    <div class="mt-4">
        <div class="flex justify-between text-green-600">
            <p>Descuento</p>
            <p>${{ number_format($pedido->descuento, 2) }}</p>
        </div>
        <div class="flex justify-between text-green-600">
            <p>Subtotal</p>
            <p>${{ number_format($pedido->subtotal, 2) }}</p>
        </div>
        <div class="flex justify-between text-green-600">
            <p>IVA</p>
            <p>${{ number_format($pedido->iva, 2) }}</p>
        </div>
        <div class="flex justify-between text-green-600">
            <p>Total</p>
            <p>${{ number_format($pedido->total, 2) }}</p>
        </div>
    </div>
    
    <!-- Botón Continuar -->
    <div class="mt-4">
        @if ($pedido->estado == 'Proceso')
        <button onclick="openPaymentSidebar()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Continuar
        </button>    
        @endif
    </div>
</div>


<!-- Sidebar de Pago  -->
<div id="paymentSidebar" class="fixed z-50 inset-y-0 right-0 bg-white text-gray-800 w-120 max-w-full shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out hidden">
    <div class="p-6">
        <div class="space-y-4">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold text-green-600">Pago</h2>
            </div>
            <!-- Métodos de Pago -->
            <div class="space-y-4">
                <h3 class="text-md font-medium text-gray-700">Métodos de pago</h3>
                <div class="flex space-x-2">
                    <button class="bg-green-600 text-white px-3 py-2 rounded-lg flex flex-col items-center space-y-1">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z"/>
                        </svg>
                        <span>Tarjeta de Crédito</span>
                    </button>
                    <button class="bg-gray-300 text-gray-500 px-3 py-2 rounded-lg flex flex-col items-center space-y-1 cursor-not-allowed opacity-60" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="paypal" width="25" height="25" fill="currentColor">
                            <path d="M20.43705,7.10449a3.82273,3.82273,0,0,0-.57281-.5238,4.72529,4.72529,0,0,0-1.15766-3.73987C17.6226,1.61914,15.77494,1,13.2144,1H7.00053A1.89234,1.89234,0,0,0,5.13725,2.5918L2.5474,18.99805A1.53317,1.53317,0,0,0,4.063,20.7832H6.72709l-.082.52051A1.46684,1.46684,0,0,0,8.0933,23h3.23438a1.76121,1.76121,0,0,0,1.751-1.46973l.64063-4.03125.01074-.05468h.29883c4.03223,0,6.55078-1.99317,7.28516-5.7627A5.149,5.149,0,0,0,20.43705,7.10449ZM7.84233,13.7041l-.71448,4.53528-.08631.54382H4.606L7.09721,3H13.2144c1.93554,0,3.31738.4043,3.99218,1.16406a2.96675,2.96675,0,0,1,.60791,2.73334l-.01861.11224c-.01215.07648-.0232.15119-.0434.24622a5.84606,5.84606,0,0,1-2.00512,3.67053,6.67728,6.67728,0,0,1-4.21753,1.183H9.70658A1.87969,1.87969,0,0,0,7.84233,13.7041Zm11.50878-2.40527c-.55078,2.82812-2.24218,4.14551-5.32226,4.14551h-.4834a1.76109,1.76109,0,0,0-1.751,1.47265l-.64941,4.07422L8.71733,21l.47815-3.03387.61114-3.85285h1.7193c.1568,0,.29541-.02356.44812-.02893.35883-.01239.71661-.02618,1.05267-.06787.20526-.02557.39362-.07221.59034-.1087.27252-.05036.54522-.10016.80108-.17127.19037-.053.368-.12121.54907-.18561.23926-.0849.4748-.174.69757-.27868.168-.0791.32807-.16706.48658-.25727a6.77125,6.77125,0,0,0,.61236-.39172c.14228-.1026.28192-.20789.415-.321a6.56392,6.56392,0,0,0,.53693-.51892c.113-.12055.2287-.23755.33331-.36725a7.09,7.09,0,0,0,.48-.69263c.07648-.12219.16126-.23523.23163-.36383a8.33175,8.33175,0,0,0,.52075-1.15326c.00867-.02386.02106-.044.02954-.068.004-.01123.00989-.02057.01386-.03186A4.29855,4.29855,0,0,1,19.35111,11.29883Z"/>
                        </svg>
                        <span>Paypal</span>
                    </button>
                    <button class="bg-gray-300 text-gray-500 px-3 py-2 rounded-lg flex flex-col items-center space-y-1 cursor-not-allowed opacity-60" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                        <span>Efectivo</span>
                    </button>
                </div>
                
                {{-- TARJETA DE CREDITO --}}
                <input type="text" placeholder="Nombre" class="bg-gray-100 text-gray-800 w-full p-2 rounded-lg">
                <input type="text" placeholder="Número" class="bg-gray-100 text-gray-800 w-full p-2 rounded-lg">
                <div class="flex space-x-2">
                    <input type="text" placeholder="Expiración" class="bg-gray-100 text-gray-800 w-1/2 p-2 rounded-lg">
                    <input type="text" placeholder="CVC" class="bg-gray-100 text-gray-800 w-1/2 p-2 rounded-lg">
                </div>
                {{-- PAYPAL 
                <input type="text" placeholder="Nombre" class="bg-gray-100 text-gray-800 w-full p-2 rounded-lg">
                <input type="text" placeholder="Número" class="bg-gray-100 text-gray-800 w-full p-2 rounded-lg">
                <div class="flex space-x-2">
                    <input type="text" placeholder="Expiración" class="bg-gray-100 text-gray-800 w-1/2 p-2 rounded-lg">
                    <input type="text" placeholder="CVC" class="bg-gray-100 text-gray-800 w-1/2 p-2 rounded-lg">
                </div>--}}
                
                {{-- EFECTIVO 
                <input type="text" placeholder="Ingrese la cantidad" class="bg-gray-100 text-gray-800 w-full p-2 rounded-lg">--}}
                
                
                <form action="{{ route('cliente.pedido.finalizar', ['id' => $pedido->id_pedido]) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white w-full py-2 rounded-lg">
                        Pagar Ahora
                    </button>
                </form>
                
            </div>
        </div>
    </div>
</div>


