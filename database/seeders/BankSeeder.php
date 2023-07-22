<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'name'  =>  'Indian Bank',
        ]);
        Bank::create([
            'name'  =>  'Canara Bank',
        ]);
        Bank::create([
            'name'  =>  'Central Bank of India',
        ]);
        Bank::create([
            'name'  =>  'Axis Bank',
        ]);
        Bank::create([
            'name'  =>  'HDFC Bank',
        ]);
        Bank::create([
            'name'  =>  'ICICI Bank',
        ]);
        Bank::create([
            'name'  =>  'IndusInd Bank',
        ]);
        Bank::create([
            'name'  =>  'IDFC First Bank',
        ]);
        Bank::create([
            'name'  =>  'State Bank of India',
        ]);
        Bank::create([
            'name'  =>  'IDBI Bank',
        ]);
        Bank::create([
            'name'  =>  'HSBC Bank',
        ]);
        Bank::create([
            'name'  =>  'Federal Bank',
        ]);
        Bank::create([
            'name'  =>  'Bank of Maharashtra',
        ]);
        Bank::create([
            'name'  =>  'Yes Bank',
        ]);
        Bank::create([
            'name'  =>  'Jammu and Kashmir Bank',
        ]);
        Bank::create([
            'name'  =>  'Kotak Mahindra Bank',
        ]);
        Bank::create([
            'name'  =>  'UCO Bank',
        ]);
        Bank::create([
            'name'  =>  'Union Bank of India',
        ]);
        Bank::create([
            'name'  =>  'Bank of Baroda',
        ]);
        Bank::firstOrCreate([
            'name' => 'Others'
        ]);
    }
}
