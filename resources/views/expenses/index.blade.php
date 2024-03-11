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
                                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Gastos</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <div class="w-full h-full flex justify-end mr-3 items-end">
                            <a href="{{ route('expenses.create') }}" class="h-full bg-green-500 hover:bg-green-600 text-gray-800 font-bold py-2 px-4 rounded" autofocus>Nuevo Gasto</a>
                        </div>
                    </div>
                    <div class="w-full">
                        <form action="{{ route('expenses.index') }}" method="GET">
                            <div class="w-full overflow-auto p-6 bg-white shadow rounded-lg flex m-auto">
                                <div class="flex justify-start">
                                    <label for="description">
                                        <input type="text" name="description" class="mt-1 p-2 border border-gray-400 rounded-md" placeholder="Buscar Gasto" value="{{ $request->input('description') }}">
                                    </label>
                                    <label for="submit" class="ml-2.5">
                                        <button type="submit" class="bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-1 p-2 pr-4 pl-4 w-full border">Buscar</button>
                                    </label>
                                </div>
                                <div class="flex mt-auto ml-auto">
                                    <label for="description" class="mt-auto ml-2.5">
                                        <select name="bank_id" autofocus class="border border-gray-400 bg-white p-3 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            <option value="0" {{ $request->input('bank_id') == 0 ? 'selected' : '' }}>Todos</option>
                                            @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}" {{ $request->input('bank_id') == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="flex m-auto">
                                    <label for="date-start" class="mt-auto ml-2.5">
                                        <input type="date" name="date-start" class="mt-1 p-2 w-full border border-gray-400 rounded-md" value="{{ old('date', $request->input('date-start', date('Y-m-01'))) }}">
                                    </label>
                                    <label for="date-end" class="mt-auto ml-2.5">
                                        <input type="date" name="date-end" class="mt-1 p-2 w-full border border-gray-400 rounded-md" value="{{ old('date', $request->input('date-end', date('Y-m-t'))) }}">
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
                                        <th>Descripcion</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @forelse($expenses as $expense)
                                        <tr class="even:bg-gray-200 odd:bg-gray-10 ">
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense->bank->name }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense->description }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense->amount }} $</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ \Carbon\Carbon::parse($expense->date)->format('d-m-Y - H:i:s') }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <a href="{{ route('expenses.edit', $expense->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
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
