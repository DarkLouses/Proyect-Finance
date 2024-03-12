@extends('layouts.app')

@section('content')
    <div class="flex overflow-hidden bg-white pt-20">
        <div class="h-screen w-full bg-gray-200 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="pt-6 px-4">
                    <div class="flex mb-5">
                        <nav class="flex w-fit px-5 py-3 text-gray-900 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">Inicio</a>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-angle-right"></i>
                                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Bancos</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <div class="w-full h-full flex justify-end mr-3 items-end">
                            <a href="{{ route('banks.create') }}" class="h-full bg-green-500 hover:bg-green-600 text-gray-800 font-bold py-2 px-4 rounded" autofocus>Nuevo Banco</a>
                        </div>
                    </div>
                    <div class="w-full">
                        <form action="{{ route('banks.index') }}" method="GET">
                            <div class="w-full overflow-auto p-6 bg-white shadow rounded-lg flex m-auto">
                                <div class="flex justify-start">
                                    <label for="description">
                                        <input type="text" name="name" class="mt-1 p-2 border border-gray-400 rounded-md" placeholder="Buscar Banco" value="{{ $request->input('name') }}">
                                    </label>
                                    <label for="submit" class="ml-2.5">
                                        <button type="submit" class="bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-1 p-2 pr-4 pl-4 w-full border">Buscar</button>
                                    </label>
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
                                        <th>N Cuenta</th>
                                        <th>Tipo</th>
                                        <th>Balance</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($banks as $bank)
                                        <tr class="even:bg-gray-200 odd:bg-gray-10 ">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $bank->name }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $bank->account_number }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $bank->account_type }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $bank->balance }} $</td>
                                            <td class="flex justify-center p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <a href="{{ route('banks.edit', $bank->id) }}" class="table-cell bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <form action="{{ route('banks.destroy', $bank->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No se han encontrado resultados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
