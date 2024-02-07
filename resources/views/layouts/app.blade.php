<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Finance') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body>
<nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
    <div class="px-3 py-5 lg:px-5 lg:pl-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                        class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                    <i id="toggleSidebarMobileHamburger" class="fa-solid fa-bars"></i>
                    <i id="toggleSidebarMobileClose" class="fa-solid fa-xmark hidden"></i>
                </button>
                <div class="text-xl font-bold flex items-center lg:ml-2.5">
                    <img src="{{ asset('image/Finance-Logo.jpeg') }}" class="w-12 h-12 mr-2.5" alt="Finance Logo">
                    <span class="self-center whitespace-nowrap">Finance</span>
                </div>
            </div>
            <div class="flex items-center relative mr-8">
                <span class="block text-sm text-black mr-2.5"> {{ Auth::user()->name }} </span>

                <img src="{{ asset(Auth::user()->profile_picture) }}" class="w-12 h-12 rounded-full mr-2.5 border-2"
                     alt="Imagen del usuario">
                <button id="button-arrow-profile">
                    <i id="arrow-open" class="fa-solid fa-arrow-down-long cursor-pointer"></i>
                    <i id="arrow-close" class="fa-solid fa-arrow-up-long cursor-pointer hidden"></i>
                </button>
                <div id="side-menu-profile"
                    class="absolute -left-8 top-2 mt-14 flex w-48 flex-col rounded-sm border border-stroke bg-white hidden">
                    <ul class="flex flex-col p-7 gap-5 border-b border-stroke px-6 py-7.5">
                        <li>
                            <a href=""
                               class="flex text-gray-950 items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base hover:text-sky-950">
                                <i class="fa-solid fa-user"></i>
                                Mi perfil
                            </a>
                        </li>
                        <li>
                            <a href=""
                               class="flex text-gray-950 items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base hover:text-sky-950">
                                <i class="fa-solid fa-gear"></i>
                                Configuracion
                            </a>
                        </li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li>
                                <button type="submit"
                                        class="flex text-gray-950 items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base hover:text-sky-950">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Cerrar Seccion
                                </button>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="sidebar"
       class="fixed hidden z-20 h-full top-0 left-0 pt-20 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
       aria-label="Sidebar">
    <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 bg-white divide-y space-y-1">
                <ul class="space-y-2 pb-2">
                    <li>
                        <a href="#"
                           class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                            <i class="fa-solid fa-landmark text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
                            <span class="ml-3">Cuentas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank"
                           class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                            <i class="fa-solid fa-truck text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75"></i>
                            <span class="ml-3 flex-1 whitespace-nowrap">Productos</span>
                        </a>
                    </li>
                </ul>
                <div class="space-y-2 pt-2">

                </div>
            </div>
        </div>
    </div>
</aside>
@yield('content')
<!--<script src="https://demo.themesberg.com/windster/app.bundle.js"></script>-->
</body>
</html>
