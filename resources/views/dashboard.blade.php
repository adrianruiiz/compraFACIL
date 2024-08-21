@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">{{ __("Bienvenido, ". Auth::user()->name) }}</h2>
                <p class="text-lg">
                    @if (Auth::user()->rol == 'admin')
                    Panel de Administración
                    @else
                    Panel del Cliente
                    @endif
                </p>
            </div>
        </div>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @if (Auth::user()->rol == 'admin')
                <!-- CATEGORIAS Card -->
                <a href="{{ route('admin.categorias.index') }}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-green-200 text-green-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-tags text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">CATEGORIAS</h5>
                            <p class="font-normal text-gray-700">Administra las categorías de los productos.</p>
                        </div>
                    </div>
                </a>
                <!-- DEPARTAMENTOS Card -->
                <a href="{{ route('admin.departamentos.index') }}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-blue-200 text-blue-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">DEPARTAMENTOS</h5>
                            <p class="font-normal text-gray-700">Gestiona los departamentos de tu organización.</p>
                        </div>
                    </div>
                </a>
                
                <!-- PRODUCTOS Card -->
                <a href="{{ route('admin.productos.index') }}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-yellow-200 text-yellow-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">PRODUCTOS</h5>
                            <p class="font-normal text-gray-700">Mantén el control de los productos en inventario.</p>
                        </div>
                    </div>
                </a>
                
                <!-- PROVEEDORES Card -->
                <a href="{{ route('admin.proveedores.index') }}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 text-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">PROVEEDORES</h5>
                            <p class="font-normal text-gray-700">Administra los proveedores de productos.</p>
                        </div>
                    </div>
                </a>
                @else
                <!-- PEDIDOS Card -->
                <a href="{{route('cliente.pedidos.index')}}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-green-200 text-green-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-tags text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h5 class="mb-2 uppercase text-2xl font-bold tracking-tight text-gray-900">Pedidos</h5>
                            <p class="font-normal text-gray-700">Consulta tus pedidos</p>
                        </div>
                    </div>
                </a>
                @endif                
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
            <div class="mb-2 text-sm font-normal">Tu pedido ha sido procesado y se encuentra en espera de confirmación.</div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    @if (session('success.pedido_id'))
                    <a href="{{ route('cliente.pedidos.index') }}" class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">Consulta tus pedidos</a>
                    @else
                    <span class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-gray-500 rounded-lg">Pedido procesado</span>
                    @endif
                </div>
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

@endsection
