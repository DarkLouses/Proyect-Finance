@extends('layouts.app')

@section('content')
    <div class="flex overflow-hidden bg-white pt-20">
        <div class="h-screen w-full bg-gray-200 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="pt-6 px-4">
                    <div class="w-full h-full flex justify-end mr-3 mb-3 items-end">
                        <a href="{{ route('expenses.create') }}" class="h-full bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus text-xl"></i>
                        </a>
                    </div>
                    <div class="w-full">
                        <form action="{{ route('expenses.filter') }}" method="GET">
                            <div class="w-full overflow-auto p-6 bg-white shadow rounded-lg flex m-auto">
                                <div class="flex justify-start">
                                    <label for="description">
                                        <input type="text" name="description" class="mt-1 p-2 border border-gray-400 rounded-md" placeholder="Buscar Gasto">
                                    </label>
                                    <label for="date-end" class="ml-2.5">
                                        <button type="submit" class="bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-1 p-2 pr-4 pl-4 w-full border">Buscar</button>
                                    </label>
                                </div>
                                <div class="flex mt-auto ml-auto">
                                    <label for="description" class="mt-auto ml-2.5">
                                        <select name="bank_id" autofocus class="border border-gray-400 bg-white p-3 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="flex m-auto">
                                    <label for="date-start" class="mt-auto ml-2.5">
                                        <input type="date" name="date" class="mt-1 p-2 w-full border border-gray-400 rounded-md" value="{{ date('Y-m-01') }}">
                                    </label>
                                    <label for="date-end" class="mt-auto ml-2.5">
                                        <input type="date" name="date" class="mt-1 p-2 w-full border border-gray-400 rounded-md" value="{{ date('Y-m-t') }}">
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
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['bank_name'] }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['expense']->description }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ $expense['expense']->amount }} $</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">{{ \Carbon\Carbon::parse($expense['expense']->date)->format('d-m-Y - H:i:s') }}</td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <a href="{{ route('expenses.edit', $expense['expense']['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                <form action="{{ route('expenses.destroy', $expense['expense']['id']) }}" method="POST">
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
                                            <td colspan="6">Aun no se han agregado gastos</td>
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
