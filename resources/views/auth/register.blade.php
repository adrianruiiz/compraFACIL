<x-guest-layout>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full mx-auto">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 relative">
            <img src="https://www.dinneratthezoo.com/wp-content/uploads/2019/02/vegetable-stir-fry-3.jpg" alt="Food Image" class="object-cover h-full w-full">
            <!-- Posicionar el logo en la parte superior izquierda -->
            <div class="absolute top-0 left-0 p-4">
                <div class="p-2 rounded-full shadow-lg">
                    <!-- Logo -->
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </div>
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-8">
            <div class="flex justify-end">
                <a href="{{ route('welcome') }}" class="text-red-500 text-xl">&times;</a>
            </div>
            <h2 class="text-4xl font-bold text-gray-800">Registrarse</h2>
            <p class="text-gray-500 mb-6">Completa el formulario para crear una cuenta</p>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nombre')" class="block text-gray-700" />
                    <x-text-input id="name" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                    </div>
                    
                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Correo Electrónico')" class="block text-gray-700" />
                        <x-text-input id="email" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                        </div>
                        
                        <!-- Teléfono -->
                        <div class="mb-4">
                            <x-input-label for="telefono" :value="__('Teléfono')" class="block text-gray-700" />
                            <x-text-input id="telefono" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="text" name="telefono" :value="old('telefono')" required autofocus autocomplete="telefono" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2 text-red-600" />
                            </div>
                            
                            <!-- Dirección -->
                            <div class="mb-4">
                                <x-input-label for="direccion" :value="__('Dirección')" class="block text-gray-700" />
                                <x-text-input id="direccion" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="text" name="direccion" :value="old('direccion')" required autofocus autocomplete="direccion" />
                                <x-input-error :messages="$errors->get('direccion')" class="mt-2 text-red-600" />
                                </div>
                                
                                <!-- Password -->
                                <div class="mb-4">
                                    <x-input-label for="password" :value="__('Contraseña')" class="block text-gray-700" />
                                    <x-text-input id="password" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="password" name="password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                                    </div>
                                    
                                    <!-- Confirm Password -->
                                    <div class="mb-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="block text-gray-700" />
                                        <x-text-input id="password_confirmation" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                                        </div>
                                        
                                        <div class="flex justify-between items-center mb-6">
                                            <a href="{{ route('login') }}" class="text-gray-500 hover:underline">¿Ya estás registrado?</a>
                                            <x-primary-button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                                                {{ __('Registrarse') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                    
                                    <div class="mt-8 text-center text-gray-500">
                                        <a href="#" class="hover:underline">Terms and Conditions & Privacy Policy</a>
                                    </div>
                                </div>
                            </div>
                        </x-guest-layout>
                        