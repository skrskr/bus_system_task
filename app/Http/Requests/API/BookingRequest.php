<?php

namespace App\Http\Requests\API;



class BookingRequest extends BaseRequest
{


    private function setRules()
    {
        // list available seats rules
        if($this->method() == 'GET')
        {
            return [
                "bus_id" => "required|exists:buses,id",
                "from_city_code" => "required_with:to_city_code|lt:to_city_code|exists:cities,number",
                "to_city_code" => "required_with:from_city_code|gt:from_city_code|exists:cities,number",
            ];
        }
        // book available seats rules
        // POST Request
        return [
            "bus_id" => "required|exists:buses,id",
            "seat_code" => "required|exists:bus_seats,seat_code",
            "from_city_code" => "required_with:to_city_code|lt:to_city_code|exists:cities,number",
            "to_city_code" => "required_with:from_city_code|gt:from_city_code|exists:cities,number",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->setRules();
    }
}
