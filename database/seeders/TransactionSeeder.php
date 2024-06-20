<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date_time = now();

        $transactions = [
            [
                'property_id' => 1,
                'price' => 1093000.50,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
        ];

        Transaction::insert($transactions);
    }
}
