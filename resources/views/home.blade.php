@extends('layouts.app')

@section('content')

    <div class="flex overflow-hidden bg-white pt-20">
        <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="pt-6 px-4">
                    <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex-shrink-0">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($total_balance, 2, '.', ',')}} $</span>
                                    <h3 class="text-base font-normal text-gray-500">Balance este mes</h3>
                                </div>
                                <div class="flex items-center justify-center flex-auto text-green-800 text-base font-bold ">
                                    @forelse ($banks as $bank)
                                        <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2.5">{{$bank->name}}</button>!-->
                                    @empty
                                    @endforelse
                                </div>

                                <div class="flex items-center justify-end flex-1 text-green-800 text-base font-bold"> 12.5%
                                    <i class="fa-solid fa-arrow-up"></i>
                                </div>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>

                        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                            <div class="mb-4 flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Ultimas transacciones</h3>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
                                </div>
                            </div>
                            <div class="flex flex-col mt-8">
                                <div class="overflow-x-auto rounded-lg">
                                    <div class="align-middle inline-block min-w-full">
                                        <div class="shadow overflow-hidden sm:rounded-lg ">
                                            <table class="min-w-full border-b">
                                                <thead class="bg-gray-50 ">
                                                    <tr>
                                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Descripcion</th>
                                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Fecha</th>
                                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Monto</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white overflow-scroll max-h-96">
                                                    @forelse ($transactions as $transaction)
                                                        <tr class="even:bg-gray-200 odd:bg-gray-10 ">
                                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{$transaction->description}}</td>
                                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{$transaction->date}}</td>
                                                            @if ($transaction->type == 'expense')
                                                                <td class="p-4 whitespace-nowrap text-sm font-semibold  text-green-900">{{$transaction->amount}} $</td>
                                                            @else
                                                                <td class="p-4 whitespace-nowrap text-sm font-semibold  text-red-900">{{$transaction->amount}} $</td>
                                                            @endif
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($total_incomes, 2, '.', ',')}} $</span>
                                    <h3 class="text-base font-normal text-gray-500">Ingresos esta semana</h3>
                                </div>
                                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-800 text-base font-bold"> 14.6%
                                    <i class="fa-solid fa-arrow-up"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($total_expenses, 2, '.', ',')}} $</span>
                                    <h3 class="text-base font-normal text-gray-500">Gastos esta semana</h3>
                                </div>
                                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-800 text-base font-bold"> 32.9%
                                    <i class="fa-solid fa-arrow-up"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$count_transtation}}</span>
                                    <h3 class="text-base font-normal text-gray-500">Transacciones esta semana</h3>
                                </div>
                                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold"> -2.7%
                                    <i class="fa-solid fa-arrow-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
                        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold leading-none text-gray-900">Deudores</h3>
                                <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2"> View all</a>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200">
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate"> Neil Sims </p>
                                                <p class="text-sm text-gray-500 truncate">
                                                    <a>Eamail</a>
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900"> $320</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                            <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Presupuesto</h3>
                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <thead>
                                        <tr>
                                            <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left border-l-0 border-r-0 whitespace-nowrap"> Categorias</th>
                                            <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left border-l-0 border-r-0 whitespace-nowrap"> Gastado</th>
                                            <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <tr class="text-gray-500">
                                            <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left"> Organic Search</th>
                                            <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4"> 5,649</td>
                                            <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                                <div class="flex items-center">
                                                    <span class="mr-2 text-xs font-medium">30%</span>
                                                    <div class="relative w-full">
                                                        <div class="w-full bg-gray-200 rounded-sm h-2">
                                                            <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
