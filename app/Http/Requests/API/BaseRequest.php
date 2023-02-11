<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    // Override failedValidation to return error message instaed of redirect
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()->all()], 422));
    }
}
