<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialGoal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Financial;

class FinancialGoalsController extends Controller
{
    public function index() {
        $financialGoals = FinancialGoal::all()->sortBy('priority');
        $totalSalary = auth()->user()->per_month_salary * 12;

        $totalDebit = 0;
        for($i = 1; $i <= 12; $i++) {
            $totalDebit += Transaction::whereMonth('date', ''.$i)->whereNotNull('amt_debit')->sum('amt_debit');
        }
        $amountRemaining = abs($totalDebit - $totalSalary);
        $divisionBtwnGoals = 3$financialGoals->count() != 0 ? ($amountRemaining / $financialGoals->count()) : 0;
        // dd($totalDebit, $amountRemaining, $divisionBtwnGoals);
        foreach($financialGoals as $financialGoal) {
            $financialGoal->percentage = ceil(($divisionBtwnGoals / $financialGoal->amount) * 100);
            $financialGoal->percentage = $financialGoal->percentage > 100 ? 100 : $financialGoal->percentage;
        }
        return view('masters.financial_goals.financial_goals', compact('financialGoals', 'amountRemaining'));
    }

    public function create() {
        return view('masters.financial_goals.create');
    }

    public function store(Request $request) {
        DB::transaction(function() use($request) {
            FinancialGoal::create([
                'name' => $request->name,
                'amount' => $request->amount,
                'priority' => $request->priority,
                'user_id' => auth()->id(),
            ]);
        });
        session()->flash('success', "Financial Goal added successfully");
        return redirect(route('financial_goals.index'));
    }

    public function destroy(int $id) {
        $goal = FinancialGoal::findOrFail($id);
        $goal->delete();
        session()->flash('success', "Financial Goal deleted successfully");
        return redirect(route('financial_goals.index'));
    }


}
