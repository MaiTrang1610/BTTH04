<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table("computers")->insert([
                "computer_name"=> $faker->word,
                'model' => $faker->lexify('Model ???'),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Ubuntu 20.04', 'macOS Big Sur']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'Intel Core i7-12700', 'AMD Ryzen 5 5600X']),
                'memory' => $faker->numberBetween(4, 64),
                'available' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
