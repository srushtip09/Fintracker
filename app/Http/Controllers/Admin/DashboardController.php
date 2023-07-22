<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants\TransactionConstants;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        $transactionsTypes = TransactionConstants::TRANSACTION_TYPE;
        $categories = Category::all();
        $categoriesCount = $categories->count();
        $transactions = Transaction::all();
        $totalTransactions = $transactions->count();

        $typePercentageMapping = [];
        $categoryPercentageMapping = [];
        $categoryWiseData = [];

        foreach($transactionsTypes as $transactionsType) {
            $percentage = $totalTransactions == 0 ? 0 : (($transactions->where('type', $transactionsType)->count())/$totalTransactions)*100;
            $typePercentageMapping[] = $percentage;
        }

        $categoryAmountWiseData = [];
        foreach($categories as $category) {
            $temp = [];
            $percentage = $categoriesCount == 0 ? 0 : (($transactions->where('category_id', $category->id)->count())/$categoriesCount)*100;;
            $categoryWiseData[] = $transactions->where('category_id', $category->id)->count();
            $categoryAmountWiseData[] = $transactions->where('category_id', $category->id)->whereNotNull('amt_debit')->sum('amt_debit');

            for($i = 1; $i <= 12; $i++) {
                $temp[] = Transaction::whereMonth('date', ''.$i)->where('category_id', $category->id)->whereNotNull('amt_debit')->sum('amt_debit');
                $categoryMonthAmountWiseData[$category->name] = $temp;
            }

            // $categoryMonthAmountWiseData[$category->name] = $transactions->where('category_id', $category->id)->whereNotNull('amt_debit')->sum('amt_debit');


            $categoryPercentageMapping[] = $percentage;
        }
        // dd($categoryMonthAmountWiseData);
        $monthWiseData = [];
        for($i = 0; $i < 12; $i++) {
            $monthWiseData[] = Transaction::whereMonth('date', ''.$i+1)->count();
        }

        $categories = $categories->pluck('name');

        $currDate = Carbon::now();

        $transaction = Transaction::whereMonth('date', $currDate->subMonth())->latest()->first();
        $openingBalance = $transaction ? $transaction->balance : 0;

        // $currMonthTransactions = Transaction::whereMonth('date', $currDate->format('m'))
        //     ->orWhereMonth('date', $currDate->subMonth()->format('m'))
        //     ->whereYear('date', $currDate->year)
        //     ->get();

        $currMonthTransactions = Transaction::get();
        $transaction = $currMonthTransactions->last();
        $closingBalance = $transaction ? $transaction->balance : 0;

        $highestSpend = $currMonthTransactions->pluck('balance')->max();
        $highestSpend = $highestSpend == null ? 0 : $highestSpend;
        $totalMoneyIn = $currMonthTransactions->pluck('amt_credit')->sum();
        $totalMoneyOut = $currMonthTransactions->pluck('amt_debit')->sum();

        return view('dashboard', compact('typePercentageMapping', 'transactionsTypes', 'categoryPercentageMapping', 'categories', 'monthWiseData',
        'categoryWiseData', 'openingBalance', 'closingBalance', 'highestSpend', 'totalMoneyIn', 'totalMoneyOut', 'categoryAmountWiseData', 'categoryMonthAmountWiseData'));
    }
}
