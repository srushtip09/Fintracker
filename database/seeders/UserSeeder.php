<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Tech Admin',
            'email' => 'tech@fintracker.com',
            'password' => Hash::make('password'),
            'per_month_salary' => 50000,
        ]);
    }
}
