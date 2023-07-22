<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants\TransactionConstants;
use App\Http\Controllers\Controller;
use App\Imports\StatementImport;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\PdfToText\Pdf;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $types = TransactionConstants::TRANSACTION_TYPE;
        return view('masters.transactions.transactions',compact('categories','types'));
    }

    public function create()
    {
        $banks = Bank::all();
        return view('masters.transactions.create', compact('banks'));
    }

    public function externalCreate() {
        $banks = Bank::all();
        $amtTypes = TransactionConstants::AMT_TYPE;
        $categories = Category::all();
        return view('masters.transactions.external-create', compact('banks', 'amtTypes', 'categories'));
    }

    public function externalStore(Request $request) {
        DB::transaction(function () use($request){
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $balance = Transaction::latest()->get()->first()->balance;
            Transaction::create([
                'reference_no' => $request->ref_no,
                'date' => $date,
                'description' => $request->desc,
                'amt_type' => $request->amountType,
                'amt_debit' => $request->amountType == "DEBIT" ? $request->amount: null,
                'amt_credit' => $request->amountType == "CREDIT" ? $request->amount: null,
                'balance' => $request->amountType == "DEBIT" ? $balance - $request->amount : $balance + $request->amount,
                'category_id' => $request->category,
                'user_id' => auth()->id(),
            ]);
        });
        session()->flash('success', "Transactions inserted successfully");
        return redirect(route('transactions.index'));
    }

    public function store(Request $request)
    {
        try {
            $file = $request->file('account_statement');
            $fileName = $file->getClientOriginalName();
            $password = $request->password;

            $file = $request->account_statement->move(public_path('assets/uploads/account_statements'), $fileName);
            $url = "http://127.0.0.1:5000/pdftocsv";
            $response = Http::post($url,$data=[
                "filename" => $fileName,
                "password" => $password,
            ])->json();

            $file = public_path("assets/output/categorized/".$fileName."-categorized.csv");
            $records = Excel::toCollection(new StatementImport(), $file)->first();
            $data = [];
            $request = $request->toArray();

            foreach($records as $record) {
                $data[] = $this->makeData($record, $request);
            }
            Transaction::insertOrIgnore($data);

        } catch(\Exception $e) {
            dd($e);
            session()->flash('error', "Some error occurred!");
            return;
        }

        session()->flash('success', "Transactions inserted successfully");
        return redirect(route('transactions.index'));
    }

    private function makeData(\Illuminate\Support\Collection $record, $request): array
    {

        if($record->get('credit') !== null) {
            $amtType = TransactionConstants::AMT_CREDIT;
        } else {
            $amtType = TransactionConstants::AMT_DEBIT;
        }

        if(str_contains($record->get('description'), "UPI")) {
            $type = TransactionConstants::UPI;
        } else if(str_contains($record->get('description'), "ATM") || str_contains($record->get('description'), "CASH")) {
            $type = TransactionConstants::CASH;
        } else {
            $type = TransactionConstants::BANK_TRANSFER;
        }

        $category = $record->get("category");
        if(str_contains($record->get('date'), "/")) {
            $tempDate =  $record->get('date');
            $date = Carbon::createFromFormat('d/m/Y', $tempDate)->format('Y-m-d');

        } else {
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($record->get('date'))->format('Y-m-d');
        }
//        dd(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($record->get('date')));
        $amount = null;
        if($record->get('amount')) {
            $newStr = str_replace(',', '',$record->get('amount'));
            $amount = intval($newStr);
        }
        $debit = null;
        if($record->get('debit')) {
            $newStr = str_replace(',', '',$record->get('debit'));
            $debit = intval($newStr);
        }
        $credit = null;
        if($record->get('credit')) {
            $newStr = str_replace(',', '',$record->get('credit'));
            $credit = intval($newStr);
        }

        $balance = null;
        if($record->get('balance')) {
            $newStr = str_replace(',', '',$record->get('balance'));
            $balance = intval($newStr);
        }
        return [
            'reference_no' => $record->get('0'),
            'date' => $date,
            'description' => $record->get('description'),
            'amt_type' => $amtType,
            'type' => $type,
            'category_id' => Category::where('name', 'like', $category)->get()->first()->id,
            'bank_id' => null,
            'bank_name' => null,
            'amt_debit' => $debit == null ? (($record->get('crdr') == "Dr.") ? $amount  : null) : $debit,
            'amt_credit' => $credit == null ? (($record->get('crdr') == "Cr.") ? $amount : null) : $credit,
            'balance' => $balance,
            'user_id' => auth()->id(),
        ];
    }


    public function show(Transaction $transaction)
    {
        //
    }

    public function edit(Transaction $transaction)
    {
        $amtTypes = TransactionConstants::AMT_TYPE;
        $categories = Category::all();
        return view('masters.transactions.edit', compact('transaction','amtTypes', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        DB::transaction(function() use($request, $transaction) {
            if(str_contains($request->date, '/')) {
                $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            } else {
                $date = $request->date;
            }
            $transaction->update([
                'reference_no' => $request->ref_no,
                'date' => $date,
                'description' => $request->desc,
                'amt_type' => $request->amountType,
                'amt_debit' => $request->amountType == "DEBIT" ? $request->amount: null,
                'amt_credit' => $request->amountType == "CREDIT" ? $request->amount: null,
                'category_id' => $request->category,
            ]);
        });
        session()->flash('success', "Transaction updated successfully");
        return redirect(route('transactions.index'));
    }

    public function getTransactionsJson(Request $request): JsonResponse
    {
        $transactions = Transaction::search($request->search['value'])
            ->order($request->order);

        $numberOfTotalRows = Transaction::count('*');
        if(!empty($request->data)) {
            if(isset($request->data['type'])) {
                $transactions->type($request->data['type']);
            }
            if(isset($request->data['category'])) {
                $transactions->category($request->data['category']);
            }
        }
        $transactions = $transactions->limitBy($request->start, $request->length);

        $transactions = $transactions->get();
        $numberOfFilteredRows = $transactions->count();
        return $this->yajraData($transactions, $numberOfFilteredRows, $numberOfTotalRows);
    }

    private function yajraData(Collection $transactions,
                               int $numberOfFilteredRows,
                               int $numberOfTotalRows
    ): JsonResponse
    {
        return DataTables::of($transactions)
            ->skipPaging()
            ->setFilteredRecords($numberOfFilteredRows)
            ->setTotalRecords($numberOfTotalRows)
            ->addColumn('transaction_type', function ($transaction) {
                return <<<STRING
              <span class="badge bg-gradient-info">$transaction->type</span>
STRING;
            })
            ->addColumn('category', function ($transaction) {
                return <<<STRING
              <span class="badge bg-gradient-primary">{$transaction->category->name}</span>
STRING;
            })
            ->addColumn('description', function ($transaction) {
                return Str::limit($transaction->description, 30);
            })
            ->addColumn('amt_type', function ($transaction) {
                if($transaction->amt_type == TransactionConstants::AMT_DEBIT) {
                    return "<span class=\"badge bg-danger\">".TransactionConstants::AMT_DEBIT."</span>";
                } else {
                    return "<span class=\"badge bg-success\">".TransactionConstants::AMT_CREDIT."</span>";
                }
            })
            ->addColumn('amount', function($transaction) {
                if($transaction->amt_type == TransactionConstants::AMT_DEBIT) {
                    return $transaction->amt_debit;
                } else {
                    return $transaction->amt_credit;
                }
            })
            ->addColumn('actions', function ($transaction) {
                return "<a href='/admin/transactions/$transaction->id/edit' class=\"\">
                <span class=\"\"><i class=\"fa fa-pencil\"></i></span></a>";
            })
            ->rawColumns(['actions', 'amt_type', 'category', 'transaction_type'])
            ->make(true);
    }
}
