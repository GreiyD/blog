<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'nickname' => ['required', 'string', 'min:4', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'max:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'nickname.required' => 'The name field is required.',
            'nickname.string' => 'The name must be a string.',
            'nickname.max' => 'The name may not be greater than 10 characters.',
            'nickname.min' => 'The name must be at least 4 characters.',
            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 4 characters.',
            'password.max' => 'The password may not be greater than 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
