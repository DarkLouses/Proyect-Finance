<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = Budget::where('user_id', auth()->id());

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $budgets = $query->get();

        return view('budgets.index', compact('budgets', 'request'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('budgets.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        auth()->user()->budgets()->create($data);

        return redirect()->route('budgets.index');
    }

    /**
     * @param Budget $budget
     * @return Factory|View|Application
     */
    public function edit(Budget $budget): Factory|View|Application
    {
        return view('budgets.edit', compact('budget'));
    }

    /**
     * @param Request $request
     * @param Budget $budget
     * @return RedirectResponse
     */
    public function update(Request $request, Budget $budget): RedirectResponse
    {
        $data = $request->all();
        $budget->update($data);

        return redirect()->route('budgets.index');
    }

    /**
     * @param Budget $budget
     * @return RedirectResponse
     */
    public function destroy(Budget $budget): RedirectResponse
    {
        $budget->delete();
        return redirect()->route('budgets.index');
    }

    /**
     * @param Budget $budget
     * @return Factory|View|Application
     */
    public function show(Budget $budget): Factory|View|Application
    {
        return view('budgets.show', compact('budget'));
    }
}
