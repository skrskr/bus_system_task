<?php

namespace App\Rules;

use App\Models\Booking;
use App\Models\BusSeat;
use Illuminate\Contracts\Validation\Rule;

class AvailableSeatRule implements Rule
{
    private $fromCityCode;
    private $busId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($busId, $fromCityCode)
    {
        $this->fromCityCode = $fromCityCode;
        $this->busId = $busId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bookedSeatIds = Booking::where("bus_id", $this->busId)->where("to_city_code", ">", $this->fromCityCode)->pluck("seat_code")->toArray();
        $availableSeats = BusSeat::whereNotIn("seat_code", $bookedSeatIds)->pluck("seat_code")->toArray();
        return in_array($value, $availableSeats);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This bus seat already booked before.';
    }
}
