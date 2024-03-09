@extends('layouts.app')

@section('content')
    <div class="flex overflow-hidden bg-white pt-20">
        <div class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="pt-6 px-4">
                    <div class="w-full">
                        <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                            <form>
                                <div>
                                    <label>
                                        <input type="search" class="bg-gray-200">
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="w-full">
                        <div class="w-full bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                            @foreach($banks as $bank)
                                {{ $bank }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
