<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BankController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = Bank::where('user_id', auth()->id());

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $banks = $query->get();

        return view('banks.index', compact('banks', 'request'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('banks.create');
    }


    /**
     * @param StoreBankRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBankRequest $request): RedirectResponse
    {
        $data = $request->validated();
        auth()->user()->banks()->create($data);
        return redirect()->route('banks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Bank $bank
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(Bank $bank): Factory|View|Application
    {
        $this->authorize('view', $bank);
        return view('bank.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bank $bank
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Bank $bank): View|Factory|Application
    {
        return view('banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBankRequest $request
     * @param Bank $bank
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(StoreBankRequest $request, Bank $bank): RedirectResponse
    {
        //$this->authorize('update', $bank);
        $data = $request->validated();
        $bank->update($data);
        return redirect()->route('banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bank $bank
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Bank $bank): RedirectResponse
    {
        //$this->authorize('delete', $bank);
        $bank->delete();
        return redirect()->route('banks.index');
    }
}
