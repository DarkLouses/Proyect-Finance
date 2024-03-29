<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use LaravelIdea\Helper\App\Models\_IH_Income_C;

class HomeController extends Controller
{
    /*
    * @return Factory|View|Application
    */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banks = auth()->user()->banks()->get();
        $userBanksIds = $banks->pluck('id')->toArray();

        $transactions = $this->getTransactions($userBanksIds);
        $total_balance = $banks->sum('balance');
        $total_incomes_month = $this->getTotalAmountWithMonth($banks, 'incomes');
        $total_expenses_month = $this->getTotalAmountWithMonth($banks, 'expenses');
        $total_incomes = $this->getTotalAmountWithWeek($banks, 'incomes');
        $total_expenses = $this->getTotalAmountWithWeek($banks, 'expenses');
        $count_transtation = $this->getTotalCountTransactionWithWeek($banks);

        return view('home', compact('banks', 'total_balance', 'total_incomes', 'total_expenses', 'count_transtation', 'transactions', 'total_expenses_month', 'total_incomes_month'));
    }


    private function getTransactions($userBanksIds)
    {
        return Income::whereIn('bank_id', $userBanksIds)->select('id', \DB::raw("DATE_FORMAT(date, '%d/%m/%Y - %H:%i:%s') as date"), 'amount', 'description', \DB::raw("'income' as type"))
            ->unionAll(Expense::whereIn('bank_id', $userBanksIds)->select('id', \DB::raw("DATE_FORMAT(date, '%d/%m/%Y - %H:%i:%s') as date"), 'amount', 'description', \DB::raw("'expense' as type")))
            ->orderBy('date', 'desc')->take(9)->get();
    }

    /**
     * @param $banks
     * @param $type
     * @return int
     */
    private function getTotalAmountWithMonth($banks, $type)
    {
        $currentMonth = date('m');

        return $banks->reduce(function ($carry, $bank) use ($type, $currentMonth) {
            return $carry + $bank->$type()->whereMonth('date', $currentMonth)->sum('amount');
        }, 0);
    }

    /**
     * @param $banks
     * @param $type
     * @return int
     */
    private function getTotalAmountWithWeek($banks, $type)
    {
        $weekRange = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];

        return $banks->reduce(function ($carry, $bank) use ($type, $weekRange) {
            return $carry + $bank->$type()->whereBetween('created_at', $weekRange)->sum('amount');
        }, 0);
    }

    /**
     * @param $banks
     * @return int
     */
    private function getTotalCountTransactionWithWeek($banks)
    {
        $weekRange = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];

        return $banks->reduce(function ($carry, $bank) use ($weekRange) {
            return $carry + $bank->incomes()->whereBetween('created_at', $weekRange)->count() + $bank->expenses()->whereBetween('created_at', $weekRange)->count();
        }, 0);
    }
}
