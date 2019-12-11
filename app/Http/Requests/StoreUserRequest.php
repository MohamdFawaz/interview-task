<?php

namespace App\Http\Requests;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreUserRequest extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country_code' => 'required|string',
            'phone_number' => 'required|phone:EG',
            'gender' => 'required|string|in:male,female',
            'birthdate' => 'required|string|date|date_format:Y-m-d',
            'avatar' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

}
