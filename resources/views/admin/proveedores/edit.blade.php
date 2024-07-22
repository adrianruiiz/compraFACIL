@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna para Edición de Proveedores (más grande) -->
            <div class="col-span-2 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Editar Proveedor</h2>
                    <div class="overflow-x-auto">
                        <!-- Formulario para editar proveedor -->
                        <form action="{{ route('admin.proveedores.update', $proveedor->id_proveedor) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_proveedor" value="{{ $proveedor->id_proveedor }}">
                            
                            <div class="space-y-4">
                                <!-- Campo para el nombre del proveedor -->
                                <div class="mb-4">
                                    <label for="nombre_proveedor" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <div class="mt-1">
                                        <input type="text" id="nombre_proveedor" name="nombre_proveedor" value="{{ old('nombre_proveedor', $proveedor->nombre_proveedor) }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('nombre_proveedor') border-red-500 @enderror">
                                        @error('nombre_proveedor')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="contacto_fiscal" class="block text-sm font-medium text-gray-700">Contacto Fiscal</label>
                                    <div class="mt-1">
                                        <input type="text" id="contacto_fiscal" name="contacto_fiscal" value="{{ old('contacto_fiscal', $proveedor->contacto_fiscal) }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('contacto_fiscal') border-red-500 @enderror">
                                        @error('contacto_fiscal')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Botones de acción -->
                                <div class="flex justify-between mt-6">
                                    <!-- Botón para regresar al índice -->
                                    <a href="{{ route('admin.proveedores.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded hover:bg-gray-600 transition duration-150">
                                        Regresar
                                    </a>
                                    <!-- Botón de actualización -->
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                                        Actualizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Columna para Información de Contacto (más pequeña) -->
                <div class="col-span-1 grid grid-cols-1 gap-6">
                    <!-- Fila 1: Información de Contacto del Proveedor -->
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-bold mb-4">Información de Contacto</h2>
                            <div class="overflow-x-auto">
                                <div class="space-y-4">
                                    <!-- Fila 1: Campo para el teléfono -->
                                    <div class="mb-4">
                                        <label for="telefono_proveedor" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                        <div class="mt-1">
                                            <input type="text" id="telefono_proveedor" name="telefono_proveedor" value="{{ old('telefono_proveedor', $proveedor->telefono_proveedor) }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('telefono_proveedor') border-red-500 @enderror">
                                            @error('telefono_proveedor')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Fila 2: Campo para el correo -->
                                    <div class="mb-4">
                                        <label for="correo_proveedor" class="block text-sm font-medium text-gray-700">Correo</label>
                                        <div class="mt-1">
                                            <input type="text" id="correo_proveedor" name="correo_proveedor" value="{{ old('correo_proveedor', $proveedor->correo_proveedor) }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('correo_proveedor') border-red-500 @enderror">
                                            @error('correo_proveedor')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Fila 3: Campo para la dirección -->
                                    <div class="mb-4">
                                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                        <div class="mt-1">
                                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('direccion') border-red-500 @enderror">
                                            @error('direccion')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
