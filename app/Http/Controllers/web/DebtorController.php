<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Debtor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DebtorController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request) : Factory|View|Application
    {
        $query = Debtor::where('user_id', auth()->id());

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $debtors = $query->get();

        return view('debtors.index', compact('debtors', 'request'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('debtors.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles_debtors', 'public');
            $data['profile_picture'] = $path;
        }

        auth()->user()->debtors()->create($data);
        return redirect()->route('debtors.index');
    }

    /**
     * @param Debtor $debtor
     * @return Factory|View|Application
     */
    public function edit(Debtor $debtor): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('debtors.edit', compact('debtor'));
    }

    /**
     * @param Request $request
     * @param Debtor $debtor
     * @return RedirectResponse
     */
    public function update(Request $request, Debtor $debtor): RedirectResponse
    {
        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            Storage::disk('public')->delete($debtor->profile_picture);

            $path = $request->file('profile_picture')->store('profiles_debtors', 'public');
            $data['profile_picture'] = $path;
        } else {
            $data['profile_picture'] = $debtor->profile_picture;
        }

        $debtor->update($data);
        return redirect()->route('debtors.index');
    }

    /**
     * @param Debtor $debtor
     * @return RedirectResponse
     */
    public function destroy(Debtor $debtor): RedirectResponse
    {
        Storage::disk('public')->delete($debtor->profile_picture);
        $debtor->delete();
        return redirect()->route('debtors.index');
    }
}
