<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionsRequest;
use App\Models\expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $expenses = collect();

        auth()->user()->banks->each(function ($userBank) use ($expenses) {
            $userBank->expenses->each(function ($expense) use ($userBank, $expenses) {
                $expenses->push([
                    'bank_name' => $userBank->name,
                    'expense' => $expense,
                ]);
            });
        });

        return view('expenses.index', compact('expenses'));
    }

    public function create(Request $request, int $bank_id)
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
        $expense = new Expense($data);
        auth()->user()->banks()->findOrFail($bank_id)->expenses()->save($expense);
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
    public function update(StoreTransactionsRequest $request, expense $expense): void
    {
        $data = $request->validated();
        auth()->user()->banks()->findOrFail($expense->bank_id)->expenses()->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param expense $expense
     * @return void
     */
    public function destroy(expense $expense): void
    {
        $expense->delete();
    }
}
