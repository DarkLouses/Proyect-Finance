<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankRequest;
use App\Models\Bank;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BankController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $banks = auth()->user()->banks;
        return view('banks.index', compact('banks'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('bank.create');
    }


    /**
     * @param StoreBankRequest $request
     * @return void
     */
    public function store(StoreBankRequest $request): void
    {
        $data = $request->validated();
        auth()->user()->banks()->create($data);
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
        $this->authorize('view', $bank);
        return view('bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBankRequest $request
     * @param Bank $bank
     * @return void
     * @throws AuthorizationException
     */
    public function update(StoreBankRequest $request, Bank $bank): void
    {
        $this->authorize('update', $bank);
        $data = $request->validated();
        $bank->update($data);

        //return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bank $bank
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Bank $bank): void
    {
        $this->authorize('delete', $bank);
        $bank->delete();
        //return redirect()->route('home');
    }
}
