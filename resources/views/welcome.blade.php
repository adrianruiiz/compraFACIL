<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>

<body class="text-gray-800 antialiased">
    @if (Route::has('login'))
    <nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 ">
        @auth
        <a
        href="{{ url('/dashboard') }}"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
        Dashboard
    </a>
    @else
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
        <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
            <a href="{{ route('login') }}" class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white">
                CompraFácil
            </a>
        </div>
        <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden" id="example-collapse-navbar">
            <ul class="flex flex-col lg:flex-row list-none mr-auto">
                <li class="flex items-center">
                    <i class="lg:text-gray-300 text-gray-500 far fa-file-alt text-lg leading-lg mr-2"></i>
                    <img src="images/logo.png" alt="Productos CompraFácil" class="w-100 h-auto rounded-lg" width="60" height="40">    
                </li>
            </ul>
            <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                <li class="flex items-center">
                    <a href="{{ route('login') }}" class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3" type="button" style="transition: all 0.15s ease 0s;">
                        <i class="fas fa-arrow-alt-circle-down"></i> Iniciar Sesión
                    </a>
                </li>
                @if (Route::has('register'))
                <li class="flex items-center">
                    <a href="{{ route('register') }}" class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3" type="button" style="transition: all 0.15s ease 0s;">
                        <i class="fas fa-arrow-alt-circle-down"></i> Registro
                    </a>
                </li>
                @endif
                @endauth                
            </ul>            
        </div>
    </div>
</nav>
@endif

<main>
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
        style='background-image: url("https://media.gettyimages.com/id/1411320685/es/foto/female-hands-confirming-the-arrival-of-a-box-of-home-delivery-filled-with-multi-coloured-fresh.jpg?s=612x612&w=0&k=20&c=z8jff18TRQ12-wmpB9lt2dwnOkHNkEizXJiZqsgcX1M=&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1267&amp;q=80");'>
        <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
    </div>
    <div class="container relative mx-auto">
        <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                <div class="pr-12">
                    <h1 class="text-white font-semibold text-5xl">
                        Bienvenido a CompraFácil
                    </h1>
                    <p class="mt-4 text-lg text-gray-300">
                        Encuentra todos tus productos de supermercado en un solo lugar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="pb-20 bg-gray-300 -mt-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                    <div class="px-4 py-5 flex-auto">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="fast-delivery" width="100" height="100" style="fill: white;">
                                <path d="M28.32 40.57a4.16 4.16 0 0 0-8.31 0v0a4.16 4.16 0 1 0 8.32.22C28.33 40.73 28.33 40.65 28.32 40.57zm-4.95 1.78a1.62 1.62 0 0 1-.92-1.41 1.64 1.64 0 0 1 0-.37 1.71 1.71 0 0 1 3.39 0 1.34 1.34 0 0 1 0 .24A1.73 1.73 0 0 1 23.37 42.35zM54.76 40.57a4.16 4.16 0 0 0-8.31 0v0a4.16 4.16 0 1 0 8.32.22C54.77 40.73 54.77 40.65 54.76 40.57zm-4.95 1.78a1.62 1.62 0 0 1-.92-1.41 1.64 1.64 0 0 1 0-.37 1.71 1.71 0 0 1 3.39 0 1.34 1.34 0 0 1 0 .24A1.73 1.73 0 0 1 49.81 42.35zM25.34 26.92q-.39 1.25-.93 2.55h.93a25.16 25.16 0 0 1 0-2.55z"></path>
                                <path d="M59,31.15l-2.69-3.6A2.87,2.87,0,0,0,54,26.37H50.5a.53.53,0,0,1-.53-.54l.09-3.55A2.92,2.92,0,0,0,47.27,19H17.45a2.88,2.88,0,0,0-2.8,2.71l-.17,1.93H10.21a1,1,0,0,0-1,.92,1,1,0,0,0,1,1h4l-.23,2.67H7.76a1,1,0,0,0-1,.92,1,1,0,0,0,1,1h6.1L13.7,33H5.31a1,1,0,0,0-1,.92,1,1,0,0,0,1,1h8.15l-.38,4.41a1.09,1.09,0,0,0,1,1.21h4.09a.54.54,0,0,0,.54-.48,5.39,5.39,0,0,1,10.68,0,.55.55,0,0,0,.54.48H44.73a.54.54,0,0,0,.54-.48,5.39,5.39,0,0,1,10.68,0,.55.55,0,0,0,.54.48h2.36a.84.84,0,0,0,.81-.87V33.14A3.32,3.32,0,0,0,59,31.15Zm-38.46.41H19.19l1.11-6h2.76l-.24,1.29h-1.4l-.2,1.1h1.23l-.23,1.25H21Zm4.9,0,0-1H24l-.42,1H22.15l2.71-6h1.53l.48,6ZM31.08,27a1.88,1.88,0,0,0-.92-.33.69.69,0,0,0-.42.12.52.52,0,0,0-.21.34q-.07.38.52.85a3.14,3.14,0,0,1,.68.79,1.57,1.57,0,0,1,.2,1.17,2.1,2.1,0,0,1-.78,1.29,2.36,2.36,0,0,1-2.56.24l.26-1.4a1.94,1.94,0,0,0,1,.38.66.66,0,0,0,.43-.14.61.61,0,0,0,.22-.38.48.48,0,0,0-.06-.34,1.72,1.72,0,0,0-.34-.38,3.54,3.54,0,0,1-.84-1,1.62,1.62,0,0,1-.13-1,2.11,2.11,0,0,1,.73-1.27,2,2,0,0,1,1.36-.49,2.53,2.53,0,0,1,1.1.25Zm4.18-.05h-.94l-.86,4.64H32.08l.86-4.64H32l.25-1.37h3.26Zm6,2.13a7.48,7.48,0,0,1-.87,2.77,7.6,7.6,0,0,1-1.88,2.25h0a1.71,1.71,0,0,1-1.27.37l-.12,0a1.72,1.72,0,0,1-.78-3l.11-.08a4.19,4.19,0,0,0,1.76-2.7,4.76,4.76,0,0,0-.7-3.3,5.77,5.77,0,0,0-2.18-2.1,7.5,7.5,0,0,0-5.51-.62,6.87,6.87,0,0,1,2.37-1.25,7,7,0,0,1,2.71-.25,7.14,7.14,0,0,1,2.63.82,7.24,7.24,0,0,1,2.14,1.79A7.32,7.32,0,0,1,41,26.2,7.41,7.41,0,0,1,41.29,29.05Zm15.56,3.19H50.79a.43.43,0,0,1-.43-.43V28.9a.57.57,0,0,1,.57-.57H54a.57.57,0,0,1,.46.23L57,32A.18.18,0,0,1,56.85,32.24Z"></path>
                            </svg>
                        </div>
                        <h6 class="text-xl font-semibold">Entrega rápida</h6>
                        <p class="mt-2 mb-4 text-gray-600">
                            Recibe tus productos en el menor tiempo posible.
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-4/12 px-4 text-center">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                    <div class="px-4 py-5 flex-auto">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" id="shopping-cart" style="fill: white;">
                                <path fill="none" d="M0 0h24v24H0V0z">
                                </path><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"></path>
                            </svg>
                        </div>
                        <h6 class="text-xl font-semibold">Precios competitivos</h6>
                        <p class="mt-2 mb-4 text-gray-600">
                            Encuentra los mejores precios en el mercado.
                        </p>
                    </div>
                </div>
            </div>
            <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                    <div class="px-4 py-5 flex-auto">
                        <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" id="lock" style="fill: white;">
                                <path d="M12,13a1,1,0,0,0-1,1v3a1,1,0,0,0,2,0V14A1,1,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"></path>
                            </svg>
                        </div>
                        <h6 class="text-xl font-semibold">Compra segura</h6>
                        <p class="mt-2 mb-4 text-gray-600">
                            Tus datos están protegidos con nuestras medidas de seguridad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap items-center mt-32">
            <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
                <div class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100">
                    <img src="images/logo.png" alt="Productos CompraFácil" class="w-100 h-auto rounded-lg" width="80" height="60">    
                </div>
                <h3 class="text-3xl mb-2 font-semibold leading-normal">
                    CompraFácil: Tu Supermercado en Línea
                </h3>
                <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                    En CompraFácil, nos enorgullecemos de ofrecerte una amplia variedad de productos, desde frescos como frutas y verduras hasta artículos de despensa como cereales y enlatados. Todo lo que necesitas para tu hogar, en un solo lugar.
                </p>
                <p class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700">
                    Nuestra plataforma en línea te permite realizar tus compras de manera rápida y segura. Además, contamos con un servicio de entrega a domicilio que garantiza que recibas tus productos en el menor tiempo posible.
                </p>
                <a href="{{ route('login') }}" class="font-bold text-gray-800 mt-8">
                    Explora nuestros productos
                </a>
            </div>
            <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-green-600">
                    <img alt="Productos frescos y de despensa de CompraFácil" src="https://media.gettyimages.com/id/1211800238/es/foto/basic-food-on-a-table-storable-for-a-long-time-eggs-oil-bread-tomato-cans-and-bags-of-potato.jpg?s=612x612&w=0&k=20&c=LB0Cd72Nriy3iLMuVL1DA5F50BJZlQZks-CuAmVHL40=" class="w-full align-middle rounded-t-lg"/>
                    <blockquote class="relative p-8 mb-4">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height: 95px; top: -94px;">
                            <polygon points="-30,95 583,95 583,65" class="text-green-600 fill-current"></polygon>
                        </svg>
                        <h4 class="text-xl font-bold text-black">
                            Calidad y Frescura Garantizada
                        </h4>
                        <p class="text-md font-light mt-2 text-black">
                            En CompraFácil, nos aseguramos de que cada producto que adquieras esté fresco y en perfectas condiciones. Nuestro compromiso es brindarte la mejor experiencia de compra desde la comodidad de tu hogar.
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section class="relative py-20 bg-white">
    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
            <polygon class="text-green-600 fill-current" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
    <div class="container mx-auto px-4">
        <div class="items-center flex flex-wrap">
            <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
                <img alt="Productos de CompraFácil" class="max-w-full rounded-lg shadow-lg" src="https://media.gettyimages.com/id/sb10067618b-001/es/foto/fidge-filled-up-with-vegetables-and-fruit-sorted-by-colour.jpg?s=612x612&w=0&k=20&c=oF2QL9KAcg2lRYMKJJFVZNz2JLowC6mp1TJISzHjKGs="/>
            </div>
            <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
                <div class="md:pr-12">
                    <div class="text-green-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-green-200">
                        <i class="fas fa-shopping-basket text-xl"></i>
                    </div>
                    <h3 class="text-3xl font-semibold text-green-600">CompraFácil: Todo lo que necesitas</h3>
                    <p class="mt-4 text-lg leading-relaxed text-gray-700">
                        En CompraFácil, te ofrecemos una experiencia de compra en línea única con una gran variedad de productos. Desde frescos como frutas y verduras hasta artículos de despensa como cereales y enlatados.
                    </p>
                    <ul class="list-none mt-6">
                        <li class="py-2">
                            <div class="flex items-center">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 mr-3">
                                        <i class="fas fa-truck"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-gray-700">
                                        Entrega a domicilio rápida y segura
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="flex items-center">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 mr-3">
                                        <i class="fas fa-apple-alt"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-gray-700">Productos siempre frescos</h4>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="flex items-center">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 mr-3">
                                        <i class="fas fa-box-open"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-gray-700">Variedad de artículos de despensa</h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

</main>
<footer class="relative bg-green-100 pt-8 pb-6">
    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
            <polygon class="text-green-100 fill-current" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
                <h4 class="text-3xl font-semibold text-green-700">¡Mantente en contacto con CompraFácil!</h4>
                <h5 class="text-lg mt-0 mb-2 text-gray-700">
                    Encuéntranos en cualquiera de estas plataformas, respondemos en 1-2 días hábiles.
                </h5>
                <div class="mt-6">
                    <button onclick="window.location.href='https://www.facebook.com/'" class="bg-white text-blue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="facebook">
                            <path fill="#1976D2" d="M14 0H2C.897 0 0 .897 0 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V2c0-1.103-.897-2-2-2z"></path>
                            <path fill="#FAFAFA" fill-rule="evenodd" d="M13.5 8H11V6c0-.552.448-.5 1-.5h1V3h-2a3 3 0 0 0-3 3v2H6v2.5h2V16h3v-5.5h1.5l1-2.5z" clip-rule="evenodd"></path>
                        </svg>
                        
                        <button onclick="window.location.href='https://www.instagram.com/'" class="bg-white text-gray-900 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" id="instagram">
                                <linearGradient id="a" x1="-37.094" x2="-26.555" y1="-72.719" y2="-84.047" gradientTransform="matrix(0 -1.982 -1.8439 0 -132.522 -51.077)" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#fd5"></stop>
                                    <stop offset=".5" stop-color="#ff543e"></stop>
                                    <stop offset="1" stop-color="#c837ab"></stop>
                                </linearGradient>
                                <path fill="url(#a)" d="m1.5 1.633c-1.886 1.959-1.5 4.04-1.5 10.362 0 6.336-.158 7.499.602 9.075.635 1.318 1.848 2.308 3.276 2.677 1.144.294 1.904.253 8.1.253 5.194 0 6.81.093 8.157-.255 1.996-.515 3.62-2.134 3.842-4.957.031-.394.031-13.185-.001-13.587-.236-3.007-2.087-4.74-4.526-5.091-.56-.081-.672-.105-3.54-.11-10.173.005-12.403-.448-14.41 1.633z"></path>
                                <path fill="#fff" d="m11.998 3.139c-3.631 0-7.079-.323-8.396 3.057-.544 1.396-.465 3.209-.465 5.805 0 2.278-.073 4.419.465 5.804 1.314 3.382 4.79 3.058 8.394 3.058 3.477 0 7.062.362 8.395-3.058.545-1.41.465-3.196.465-5.804 0-3.462.191-5.697-1.488-7.375-1.7-1.7-3.999-1.487-7.374-1.487zm-.794 1.597c4.346-.007 7.811-.607 8.006 3.683.072 1.589.072 5.571 0 7.16-.189 4.137-3.339 3.683-7.211 3.683-3.412 0-5.104.121-6.244-1.02-1.157-1.157-1.019-2.811-1.019-6.245 0-4.071-.385-7.026 3.683-7.213.817-.037 1.134-.048 2.785-.05zm5.524 1.471c-.587 0-1.063.476-1.063 1.063s.476 1.063 1.063 1.063 1.063-.476 1.063-1.063-.476-1.063-1.063-1.063zm-4.73 1.243c-2.513 0-4.55 2.038-4.55 4.551s2.037 4.55 4.55 4.55 4.549-2.037 4.549-4.55-2.036-4.551-4.549-4.551zm0 1.597c1.631 0 2.953 1.323 2.953 2.954s-1.322 2.954-2.953 2.954-2.953-1.323-2.953-2.954c0-1.632 1.322-2.954 2.953-2.954z"></path>
                            </svg>
                        </button>
                        
                    </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                    <div class="flex flex-wrap items-top mb-6">
                        <div class="w-full lg:w-4/12 px-4 ml-auto">
                            <span class="block uppercase text-gray-600 text-sm font-semibold mb-2">Enlaces Útiles</span>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm" href="#about-us">
                                        Sobre Nosotros
                                    </a>
                                </li>
                                
                                <li>
                                    <a class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm" href="#contact">
                                        Contacto
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </div>
                        <div class="w-full lg:w-4/12 px-4">
                            <span class="block uppercase text-gray-600 text-sm font-semibold mb-2">Otros Recursos</span>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm" href="#terms">
                                        Términos y Condiciones
                                    </a>
                                </li>
                                <li>
                                    <a class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm" href="#privacy">
                                        Política de Privacidad
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-green-300" />
            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                    <div class="text-sm text-gray-600 font-semibold py-1">
                        Copyright © 2024 CompraFácil.
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</body>

</html>