@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">{{ __("Bienvenido, ". Auth::user()->name) }}</h2>
                <p class="text-lg">Panel de Administración</p>
            </div>
        </div>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
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
                <a href="{{ route('dashboard') }}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
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
                <a href="{{ route('dashboard') }}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
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
            </div>
        </div>
    </div>
</div>
@endsection
