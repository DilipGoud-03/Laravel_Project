<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authorization extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:5|confirmed'

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name must be required',
            'name' => 'Name must be a string',
            'name.max' => 'Name must be Max 20 characters',

            'email.required' => 'Email must be required',
            'email.email' => 'must be required a valid email',
            'email.max' => 'Email must be Max 150 characters',
            'email.unique' => 'This email is all ready exist',

            'password.required' => 'Password must be required',
            'password.min' => 'Password must be 5 characters',
            'password.confirmed' => 'Password does not matched',

        ];
    }
}
