<?php

namespace Database\Seeders;

use App\Models\TransactionUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $current_date_time = now();

        $transaction_users = [
            [
                'transaction_id' => 1,
                'user_id' => 2,
                'percentage' => 5,
                'commission' => 54650,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
            [
                'transaction_id' => 1,
                'user_id' => 3,
                'percentage' => 3,
                'commission' => 32790,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
        ];

        TransactionUser::insert($transaction_users);
    }
}
