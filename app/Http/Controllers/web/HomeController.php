<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index (): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $total_incomes = 0;
        $total_expenses = 0;
        $count_incomes = 0;
        $count_expenses = 0;

        $banks = auth()->user()->banks()->get();
        $total_balance = $banks->sum('balance');

        $incomes = Income::select('id', \DB::raw("DATE_FORMAT(date, '%d/%m/%Y - %H:%i:%s') as date"), 'amount', 'description', \DB::raw("'income' as type"));
        $expenses = Expense::select('id', \DB::raw("DATE_FORMAT(date, '%d/%m/%Y - %H:%i:%s') as date"), 'amount', 'description', \DB::raw("'expense' as type"));
        $transactions = $incomes->unionAll($expenses)->orderBy('date', 'desc')->take(9)->get();

        $banks->each(function ($bank) use ($startDate, $endDate, &$total_incomes, &$total_expenses, &$count_incomes, &$count_expenses) {
            $incomes = $bank->incomes()->whereBetween('created_at', [$startDate, $endDate])->get();
            $total_incomes += $incomes->sum('amount');
            $count_incomes += $incomes->count();

            $expenses = $bank->expenses()->whereBetween('created_at', [$startDate, $endDate])->get();
            $total_expenses += $expenses->sum('amount');
            $count_expenses += $expenses->count();
        });

        $count_transtation = $count_expenses + $count_incomes;

        return view('/home', compact('banks', 'total_balance', 'total_incomes', 'total_expenses', 'count_transtation', 'transactions'));
    }

}
