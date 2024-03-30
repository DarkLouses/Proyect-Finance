<?php

use App\Http\Controllers\web\BankController;
use App\Http\Controllers\web\BudgetController;
use App\Http\Controllers\web\ExpenseController;
use App\Http\Controllers\web\IncomeController;
use App\Http\Controllers\web\DebtorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn () => auth()->check() ? redirect('home') : view('auth/login'));
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('banks', BankController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('incomes', IncomeController::class);
    Route::resource('debtors', DebtorController::class);
    Route::resource('budgets', BudgetController::class);
});
