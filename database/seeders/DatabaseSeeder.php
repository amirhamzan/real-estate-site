<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('secret'),
            'about' => "Hi, I am Super Admin.",
        ]);

        User::factory()->create([
            'name' => 'Ernie',
            'email' => 'ernie@example.com',
            'password' => Hash::make('secret'),
            'about' => "Hi, I am Ernie.",
        ]);

        User::factory()->create([
            'name' => 'Aliza',
            'email' => 'aliza@example.com',
            'password' => Hash::make('secret'),
            'about' => "Hi, I am Aliza.",
        ]);

        $this->call([
            PropertyTypeSeeder::class,
            PropertySeeder::class,
            TransactionSeeder::class,
            TransactionUserSeeder::class,
            RolePermissionSeeder::class,
        ]);
    }
}
