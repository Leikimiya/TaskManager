<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class UserRegisterRequest extends FormRequest
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
            'email'=>['required','string','email','unique:users,email'],
            'password'=>['required','string','confirmed',Password::min(6)],
            'name'=>['required', 'string','max:255'],
            'lastname'=>['required', 'string','max:255'],
            'birth'=>['required','date_format:Y-m-d']
        ];
    }
}
