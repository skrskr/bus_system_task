<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            [
                "name" => "Cairo",
                "number" => 1
            ],
            [
                "name" => "Giza",
                "number" => 2
            ],
            [
                "name" => "AlFayyum",
                "number" => 3
            ],
            [
                "name" => "AlMinya",
                "number" => 4
            ],
            [
                "name" => "Asyut",
                "number" => 5
            ]
        ]);
    }
}
