<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankUserRequest;
use App\Models\Bank;
use App\Models\user;
use Illuminate\Support\Facades\DB;

class BankUserController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(StoreBankUserRequest $request): void
    {
        $data = $request->validated();
        $user = User::where('id', $data['user_id'])->first(['id']);
        $bank = Bank::where('id', $data['bank_id'])->first(['id']);

        $bank->banksUsers()->attach($user->id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $bankUser = DB::selectOne('SELECT * FROM bankuser Where id = ? [$id]');
        $bank = Bank::findorFail($bankUser->bank_id);

        abort_if($bank->user_id !== auth()->id(), 403);
        $bank->banksUsers()->detach($bankUser->user_id);
    }
}
