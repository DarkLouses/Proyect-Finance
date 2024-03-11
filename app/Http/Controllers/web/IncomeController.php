<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionsRequest;
use App\Models\Income;
use Carbon\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $banks = auth()->user()->banks;

        $query = Income::query();

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
        $incomes = $query->whereIn('bank_id', $banks->pluck('id'))->get();

        return view('incomes.index', compact('incomes', 'banks', 'request'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banks = auth()->user()->banks;
        return view('incomes.create', compact('banks'));
    }

    public function store(StoreTransactionsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $bank_id = $data['bank_id'];
        $income = new Income($data);
        auth()->user()->banks()->findOrFail($bank_id)->incomes()->save($income);

        return redirect()->route('incomes.index');
    }

    public function show(Income $income): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('incomes.edit', compact('income'));
    }

    public function edit(Income $income): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banks = auth()->user()->banks;
        return view('incomes.edit', compact('income', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTransactionsRequest $request
     * @param income $income
     * @return RedirectResponse
     */
    public function update(StoreTransactionsRequest $request, Income $income): RedirectResponse
    {
        $data = $request->validated();
        $income->update($data);
        return redirect()->route('incomes.index');
    }

    public function destroy(Income $income): RedirectResponse
    {
        $income->delete();
        return redirect()->route('incomes.index');
    }
}
