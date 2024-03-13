<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionsRequest;
use App\Models\Expense;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function index(Request $request): Factory|View|Application
    {
        $banks = auth()->user()->banks;

        $query = Expense::query();

        if ($request->filled('date-start') && $request->filled('date-end')) {
            $query->whereBetween('date', [$request->input('date-start'), $request->input('date-end')]);
        } elseif ($request->filled('date-start')) {
            $query->where('date', '>=', $request->input('date-start'));
        } elseif ($request->filled('date-end')) {
            $query->where('date', '<=', $request->input('date-end'));
        }

        if ($request->has('bank_id') && $request->bank_id > 0) {
            $query->where('bank_id', $request->bank_id);
        }

        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        $query->with('bank');
        $expenses = $query->whereIn('bank_id', $banks->pluck('id'))->get();

        return view('expenses.index', compact('expenses', 'banks', 'request'));
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

        $bank = auth()->user()->banks()->findOrFail($bank_id);
        $bank->incomes()->save($expense);
        $bank->balance -= $expense->amount;
        $bank->save();

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

        $originalAmount = $expense->amount;
        $expense->update($data);

        $bank = auth()->user()->banks()->findOrFail($expense->bank_id);
        if ($originalAmount != $data['amount']) {
            $bank->balance -= $data['amount'] - $originalAmount;
            $bank->save();
        }
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
        $bank = auth()->user()->banks()->findOrFail($expense->bank_id);
        $bank->incomes()->save($expense);
        $bank->balance += $expense->amount;
        $bank->save();
        $expense->delete();

        return redirect()->route('expenses.index');
    }
}
