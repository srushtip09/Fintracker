<?php

namespace App\Console\Commands;

use App\Helpers\Constants\TransactionConstants;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Console\Command;

class FillDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transactions = [];
        $faker = Factory::create(['en-in']);

        Transaction::insert($transactions);
        return 0;
    }

    private function makeData($faker): array
    {
        if(isset($request['bank_name']) && $request['bank_name'] !== null) {
            $bankName = $request['bank_name'];
        } else {
            $bankName = Bank::find($request['bank_id'])->name;
        }

        if($record->get('amount_credit') !== null) {
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

        $category = Category::InRandomOrder()->first();

        if(str_contains($record->get('date'), "/")) {
            $tempDate =  $record->get('date');
            $date = Carbon::createFromFormat('d/m/y', $tempDate)->format('Y-m-d');

        } else {
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($record->get('date'))->format('Y-m-d');
        }

//        dd(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($record->get('date')));
        return [
            'reference_no' => $record->get('reference_no'),
            'date' => $date,
            'description' => $record->get('description'),
            'amt_type' => $amtType,
            'type' => $type,
            'category_id' => $category->id,
            'bank_id' => $request['bank_id'],
            'bank_name' => $bankName,
            'amt_debit' => $record->get('amount_debit'),
            'amt_credit' => $record->get('amount_credit'),
            'balance' => $record->get('balance'),
        ];
    }
}
