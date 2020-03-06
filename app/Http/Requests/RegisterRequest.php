<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Please enter your username',
            'email.required' => 'Please enter your email',
            'password.required' => 'Please enter your password',

            'email.email' => 'Email invalid',

            'password.min' => 'Password must be at least 6 characters',
        ];
    }
}
