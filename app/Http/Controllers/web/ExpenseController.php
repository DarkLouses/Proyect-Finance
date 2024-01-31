<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionsRequest;
use App\Models\expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request,  int $bank_id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransactionsRequest $request
     * @return void
     */
    public function store(StoreTransactionsRequest $request): void
    {
        $data = $request->validated();
        $bank_id = $data['bank_id'];
        $user = auth()->user();
        $bank = $user->banks()->findOrFail($bank_id);
        $expense = new Expense($data);
        $bank->expenses()->save($expense);
    }

    public function show(expense $expense)
    {
        //
    }

    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTransactionsRequest $request
     * @param expense $expense
     * @return void
     */
    public function update(StoreTransactionsRequest $request, expense $expense) : void
    {
        $data = $request->validated();
        $user = auth()->user();
        $bank = $user->banks()->findOrFail($expense->bank_id);
        $bank->expenses()->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param expense $expense
     * @return void
     */
    public function destroy(expense $expense) : void
    {
        $expense->delete();
    }
}
