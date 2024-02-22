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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'naam',
            'name.min' => 'naam min2',
            'email.unique:users' => 'email unique2',
            'email.unique' => 'email unique',
            'email.required' => 'email required',
            'password.required' => 'password required',
            'password.min:6' => 'password min6',
        ];
    }
}
