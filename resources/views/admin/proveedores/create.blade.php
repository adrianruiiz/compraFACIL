@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor de dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Columna para Alta de Categorías (más grande) -->
            <div class="col-span-2 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Alta de Proveedor</h2>
                    <div class="overflow-x-auto">
                        <!-- Formulario para agregar categorías -->
                        <form action="{{ route('admin.proveedores.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <!-- Campo para el nombre de la categoría -->
                                <div class="mb-4">
                                    <label for="nombre_proveedor" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <div class="mt-1">
                                        <input type="text" id="nombre_proveedor" name="nombre_proveedor" value="{{ old('nombre_proveedor') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('nombre_proveedor') border-red-500 @enderror">
                                        @error('nombre_proveedor')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="contacto_fiscal" class="block text-sm font-medium text-gray-700">Contacto Fiscal</label>
                                    <div class="mt-1">
                                        <input type="text" id="contacto_fiscal" name="contacto_fiscal" value="{{ old('contacto_fiscal') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('contacto_fiscal') border-red-500 @enderror">
                                        @error('contacto_fiscal')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Botón de envío -->
                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#4CAF50] text-white text-sm font-medium rounded hover:bg-[#45A049] transition duration-150">
                                        Añadir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Columna para Alta de Proveedores -->
                <div class="col-span-1 grid grid-cols-1 gap-6">
                    <!-- Fila 1: Columna para Alta de Proveedores -->
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-bold mb-4">Contacto</h2>
                            <div class="overflow-x-auto">
                                <div class="space-y-4">
                                    <!-- Fila 1: Campo para el telefono -->
                                    <div class="mb-4">
                                        <label for="telefono_proveedor" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                        <div class="mt-1">
                                            <input type="text" id="telefono_proveedor" name="telefono_proveedor" value="{{ old('telefono_proveedor') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('telefono_proveedor') border-red-500 @enderror">
                                            @error('telefono_proveedor')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Fila 2: Campo para el correo -->
                                    <div class="mb-4">
                                        <label for="correo_proveedor" class="block text-sm font-medium text-gray-700">Correo</label>
                                        <div class="mt-1">
                                            <input type="text" id="correo_proveedor" name="correo_proveedor" value="{{ old('correo_proveedor') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('correo_proveedor') border-red-500 @enderror">
                                            @error('telefono_proveedor')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Fila 3: Campo para la direccion -->
                                    <div class="mb-4">
                                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                        <div class="mt-1">
                                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-[#4CAF50] focus:border-[#4CAF50] @error('direccion') border-red-500 @enderror">
                                            @error('direccion')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
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
@endsection
