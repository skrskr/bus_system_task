<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\BusSeat;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfSeats = 12;
        $bus = Bus::create([
            "name" => "Bus1",
            "number" => "bus-123",
            "number_of_seats" => $numberOfSeats
        ]);

        $seats = [];
        for ($i=1; $i <= $bus->number_of_seats; $i++) { 
            $seats[] = [
                'bus_id' => $bus->id,
                'seat_code' => $i,
            ];
        }
        BusSeat::insert($seats);
    }
}
