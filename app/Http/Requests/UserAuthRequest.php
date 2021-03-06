<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthRequest extends FormRequest
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
            'email'=>['required','email','exists:users,email'],
            'password'=>['required','string','min:6'],
        ];
    }
    public function messages()
    {
        return [
            'email.exists'=>'Неверный Email',
            'password.required'=>'Не заполнен пароль',
            'password.min:6'=>'пароль менее 6 символов',
        ];
    }
}
