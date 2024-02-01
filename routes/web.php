<?php

use App\Http\Controllers\web\BankController as WebBankController;
use App\Http\Controllers\web\ExpenseController;
use App\Http\Controllers\web\IncomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => auth()->check() ? redirect('/home') : view('welcome'));

Route::middleware(['auth'])->group(function () {
    Route::resource('banks', WebBankController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('income', IncomeController::class);
    Route::resource('bank-user', \App\Http\Controllers\web\BankUserController::class)->except(['show', 'edit', 'update']);
});
