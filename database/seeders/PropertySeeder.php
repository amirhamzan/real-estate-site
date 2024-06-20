<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date_time = now();

        $properties = [
            [
                'name' => 'Modern Comfort: 3-Bedroom Single Level',
                'address' => '1 / 41 Pomaria Road, Henderson, Waitakere City, Auckland 0610',
                'property_type_id' => 1,
                'floor_area' => 110.00,
                'land_area' => 473.50,
                'price' => 893000,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
            [
                'name' => 'Elite St Leonards Rd DGZ Residence',
                'address' => '57 Saint Leonards Road, Mount Eden, Auckland City, Auckland 1024',
                'property_type_id' => 2,
                'floor_area' => 375.00,
                'land_area' => 809.50,
                'price' => 4380000,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],
            [
                'name' => 'Spacious 3-Bed Condominium with 2 Living',
                'address' => '4 / 67 Kervil Avenue, Te Atatu Peninsula, Waitakere City, Auckland 0610',
                'property_type_id' => 3,
                'floor_area' => 99.00,
                'land_area' => 103.50,
                'price' => 750000,
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time,
            ],

        ];

        Property::insert($properties);
    }
}
