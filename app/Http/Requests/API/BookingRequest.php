<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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

    // Override failedValidation to return error message instaed of redirect
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()->all()], 422));
    }
}
