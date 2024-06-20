<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date_time = now();

        $property_types = [
            [
                'name' => 'terrace',
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
            [
                'name' => 'appartment',
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
            [
                'name' => 'condominium',
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],

        ];

        PropertyType::insert($property_types);
    }
}
