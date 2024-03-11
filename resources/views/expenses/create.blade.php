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
                                <i class="fa-solid fa-angle-right"></i>
                                <li class="inline-flex items-center">
                                    <a href="{{ route('expenses.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">Gastos</a>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-angle-right"></i>
                                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Nuevo</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="pt-4 px-4">
                    <div class="w-full mt-8 flex justify-center">
                        <div class="w-fit bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2 overflow-x-auto flex justify-center">
                            <form action="{{ route('expenses.store') }}" method="POST">
                                @csrf
                                <section class="flex justify-center flex-col">
                                    <div class="w-fit">
                                        <div class="m-auto mt-3">
                                            <label for="description">Banco
                                                <select name="bank_id" autofocus class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    @foreach($banks as $bank)
                                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>
                                        <div class="m-auto mt-6">
                                            <label for="description" class="m-auto mt-3">Descripcion
                                                <input type="text" name="description" class="mt-1 p-2 w-full border rounded-md">
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-2 mt-6">
                                            <label for="amount" class="mr-2">Monto
                                                <input type="text" name="amount" class="mt-1 p-2 w-full border rounded-md">
                                            </label>
                                            <label for="date-">Fecha
                                                <input type="datetime-local" name="date" class="mt-1 p-2 w-full border rounded-md" value="{{ now()->format('Y-m-d H:i:s') }}">
                                            </label>
                                        </div>
                                        <div class="mt-6">
                                            <button type="submit" class="w-full bg-blue-500 text-white rounded-md hover:bg-blue-600 p-3 mt-3">Aceptar</button>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
