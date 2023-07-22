<?php

use App\Http\Controllers\Admin\FinancialGoalsController;
use App\Http\Controllers\Admin\TransactionsController;
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
Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('transactions/external/create/', [TransactionsController::class,'externalCreate'])->name('transactions.externalCreate');
Route::post('transactions/external/store/', [TransactionsController::class,'externalStore'])->name('transactions.externalStore');

Route::resource('transactions', App\Http\Controllers\Admin\TransactionsController::class)->except(['destroy']);
Route::post('transactions/getTransactions/ajax', [\App\Http\Controllers\Admin\TransactionsController::class, 'getTransactionsJson'])->name('transactions.getTransactionJson');

Route::resource('financial_goals', FinancialGoalsController::class);



