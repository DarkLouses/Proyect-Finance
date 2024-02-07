<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Obtener la fecha de inicio y fin de la semana actual
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Inicializar las variables para la suma y el conteo de ingresos y gastos
        $total_incomes = 0;
        $total_expenses = 0;
        $count_incomes = 0;
        $count_expenses = 0;

        // Obtener los bancos asociados al usuario
        $banks = auth()->user()->banks()->get();

        // Iterar sobre cada banco
        $banks->each(function ($bank) use ($startDate, $endDate, &$total_incomes, &$total_expenses, &$count_incomes, &$count_expenses) {
            // Filtrar los ingresos de la semana actual y sumarlos
            $incomes = $bank->incomes()->whereBetween('created_at', [$startDate, $endDate])->get();
            $total_incomes += $incomes->sum('amount');
            $count_incomes += $incomes->count();

            // Filtrar los gastos de la semana actual y sumarlos
            $expenses = $bank->expenses()->whereBetween('created_at', [$startDate, $endDate])->get();
            $total_expenses += $expenses->sum('amount');
            $count_expenses += $expenses->count();
        });

        $count_transtation = $count_expenses+$count_incomes;
        // Calcular el saldo total de los bancos
        $total_balance = $banks->sum('balance');
        return view('/home', compact('banks', 'total_balance', 'total_incomes', 'total_expenses', 'count_transtation'));
    }

}
