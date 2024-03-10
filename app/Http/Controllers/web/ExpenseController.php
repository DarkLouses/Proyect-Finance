<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionsRequest;
use App\Models\Expense;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenseController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $expenses = collect();
        $banks = auth()->user()->banks;

        $banks->each(function ($userBank) use ($expenses) {
            $userBank->expenses->each(function ($expense) use ($userBank, $expenses) {
                $expenses->push([
                    'bank_name' => $userBank->name,
                    'expense' => $expense,
                ]);
            });
        });

        return view('expenses.index', compact('expenses', 'banks'));
    }

    public function filter(): Factory|View|Application
    {
        $expenses = collect();
        $banks = auth()->user()->banks;

        $banks->each(function ($userBank) use ($expenses) {
            $userBank->expenses->each(function ($expense) use ($userBank, $expenses) {
                $expenses->push([
                    'bank_name' => $userBank->name,
                    'expense' => $expense,
                ]);
            });
        });

        return view('expenses.index', compact('expenses', 'banks'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banks = auth()->user()->banks;
        return view('expenses.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransactionsRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTransactionsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $bank_id = $data['bank_id'];
        $expense = new Expense($data);
        auth()->user()->banks()->findOrFail($bank_id)->expenses()->save($expense);

        return redirect()->route('expenses.index');
    }

    /**
     * @param expense $expense
     * @return Factory|View|Application
     */
    public function show(expense $expense): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * @param expense $expense
     * @return Factory|View|Application
     */
    public function edit(expense $expense): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banks = auth()->user()->banks;
        return view('expenses.edit', compact('expense', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTransactionsRequest $request
     * @param expense $expense
     * @return RedirectResponse
     */
    public function update(StoreTransactionsRequest $request, expense $expense): RedirectResponse
    {
        $data = $request->validated();
        $expense->update($data);
        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param expense $expense
     * @return RedirectResponse
     */
    public function destroy(expense $expense): RedirectResponse
    {
        $expense->delete();
        return redirect()->route('expenses.index');
    }
}
