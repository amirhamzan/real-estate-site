<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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

        // Dummy faker properties
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) { // Adjust the range as needed
            DB::table('properties')->insert([
                'name' => $faker->company . ' Property',
                'address' => $faker->address,
                'property_type_id' => $faker->numberBetween(1, 3),
                'floor_area' => $faker->numberBetween(50, 500), // Assuming floor area in square meters
                'land_area' => $faker->numberBetween(100, 1000), // Assuming land area in square meters
                'price' => $faker->numberBetween(100000, 1000000), // Assuming price in dollars
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
