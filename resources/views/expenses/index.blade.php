@extends('layouts.app')

@section('content')

    <div class="flex overflow-hidden bg-white pt-20">
        <div class="h-screen w-full bg-gray-200 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="pt-6 px-4">
                    <div class="w-full overflow-auto">
                        <form action="">
                            <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 grid grid-cols-2 gap-4">
                                <div class="relative w-80">
                                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required/>
                                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                </div>
                                <div class="flex justify-end">
                                    <div class="relative w-44 ">
                                        <input type="date" id="search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required/>
                                    </div>
                                    <div class="relative w-44 ml-3">
                                        <input type="date" id="search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required/>
                                    </div>
                                    <div class="relative w-16 h-full ml-3 flex justify-center items-center">
                                        <a href="#" class="flex justify-center items-center w-full h-full bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            <i class="fa-solid fa-plus text-xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="w-full mt-8">
                        <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2 overflow-x-auto">
                            <table class="min-w-full border-b text-black font-medium text-center text-xl p-4 ">
                                <thead class="bg-gray-200">
                                    <tr class="h-16">
                                        <th>Banco</th>
                                        <th>Descripcion</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach($expenses as $expense)
                                        <tr class="even:bg-gray-200 odd:bg-gray-10 ">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['bank_name'] }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['expense']['description'] }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['expense']['amount'] }} $</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['expense']['date'] }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
