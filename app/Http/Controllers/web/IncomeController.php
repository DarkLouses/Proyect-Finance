<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionsRequest;
use App\Models\Income;

class IncomeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreTransactionsRequest $request): void
    {
        $data = $request->validated();
        $bank_id = $data['bank_id'];
        $income = new Income($data);
        auth()->user()->banks()->findOrFail($bank_id)->incomes()->save($income);
    }

    public function show(Income $income)
    {
        //
    }

    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTransactionsRequest $request
     * @param income $income
     * @return void
     */
    public function update(StoreTransactionsRequest $request, Income $income): void
    {
        $data = $request->validated();
        auth()->user()->banks()->findOrFail($income->bank_id)->incomes()->update($data);
    }

    public function destroy(Income $income): void
    {
        $income->delete();
    }
}
