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
                        <button id="toggleSidebarMobile" class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                            <i id="toggleSidebarMobileHamburger" class="fa-solid fa-bars"></i>
                            <i id="toggleSidebarMobileClose" class="fa-solid fa-xmark hidden"></i>
                        </button>
                        <div class="text-xl font-bold flex items-center lg:ml-2.5">
                            <a href="{{ route('home') }}" class="self-center whitespace-nowrap">Finance</a>
                        </div>
                    </div>
                    <div class="flex items-center relative mr-8">
                        <button id="button-arrow-profile">
                            <div class="flex items-center">
                                <span class="hidden md:block text-sm text-black mr-3"> {{ Auth::user()->name }} </span>
                                <img src="{{ Storage::url(auth()->user()->profile_picture) ?? asset(Auth::user()->profile_picture) }}" class="w-12 h-12 rounded-full" alt="Imagen del usuario">
                            </div>
                        </button>
                        <div id="side-menu-profile" class="absolute -left-8 top-2 mt-14 flex w-48 flex-col rounded-sm border border-stroke bg-white hidden">
                            <ul class="flex flex-col p-7 gap-5 border-b border-stroke px-6 py-7.5">
                                <li>
                                    <a href="{{ route('auth.edit', auth()->id()) }}" class="flex text-gray-950 items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base hover:text-sky-950">
                                        <i class="fa-solid fa-gear"></i> Configuración
                                    </a>
                                </li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <li>
                                        <button type="submit" class="flex text-gray-950 items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base hover:text-sky-950">
                                            <i class="fa-solid fa-right-from-bracket"></i>Cerrar Sección
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="sidebar" class="fixed hidden z-20 h-full top-0 left-0 pt-20 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75" aria-label="Sidebar">
            <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex-1 px-3 bg-white divide-y space-y-1">
                        <ul class="space-y-2 pb-2">
                            <li>
                                <a href="{{ route('banks.index') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                    <i class="fa-solid fa-landmark text-gray-500"></i>
                                    <span class="ml-3 flex-1 whitespace-nowrap">Cuentas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('incomes.index') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                    <i class="fa-solid fa-coins text-gray-500"></i>
                                    <span class="ml-3 flex-1 whitespace-nowrap">Ingresos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('expenses.index') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                    <i class="fa-solid fa-money-bill text-gray-500"></i>
                                    <span class="ml-3 flex-1 whitespace-nowrap">Gastos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('budgets.index') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                    <i class="fa-solid fa-wallet text-gray-500"></i>
                                    <span class="ml-3 flex-1 whitespace-nowrap">Presupuestos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('debtors.index') }}" class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group">
                                    <i class="fa-solid fa-hand-holding-dollar text-gray-500"></i>
                                    <span class="ml-3 flex-1 whitespace-nowrap">Deudores</span>
                                </a>
                            </li>
                        </ul>
                        <div class="space-y-2 pt-2"></div>
                    </div>
                </div>
            </div>
        </aside>
        @yield('content')
    </body>
</html>
