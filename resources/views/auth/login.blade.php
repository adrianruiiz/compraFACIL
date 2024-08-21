<x-guest-layout>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full mx-auto">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 relative">
            <img src="https://media.gettyimages.com/id/629642659/es/foto/mom-daughter-shopping-at-supermarket.jpg?s=612x612&w=0&k=20&c=ztG5xfoqN6B9qAV_sxExzudlIVt8obY_66d2Puo0G40=" alt="Food Image" class="object-cover h-full w-full">
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
            <h2 class="text-4xl font-bold text-gray-800">Bienvenido</h2>
            <p class="text-gray-500 mb-6">Ingresa tus credenciales</p>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Nombre de usuario o Email')" class="block text-gray-700" />
                    <x-text-input id="email" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Contraseña')" class="block text-gray-700" />
                        <x-text-input id="password" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex justify-between items-center mb-6">
                            <a href="{{ route('password.request') }}" class="text-green-500 hover:underline">Olvidé mi contraseña</a>
                            <x-primary-button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                                {{ __('OK') }}
                            </x-primary-button>
                        </div>
                    </form>
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ route('register') }}" class="text-gray-500 hover:underline">Crear Cuenta</a>
                    </div>
                    <div class="mt-8 text-center text-gray-500">
                        <a href="#" class="hover:underline">Terms and Conditions & Privacy Policy</a>
                    </div>
                </div>
            </div>
        </x-guest-layout>
        