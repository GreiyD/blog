<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileEditFormRequest extends FormRequest
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
            'full_name' => 'nullable|string|max:100',
            'age' => 'nullable|integer|min:18|max:100',
            'city' => 'nullable|string|max:100',
            'info' => 'nullable|string|max:500',
            'photo_path' => 'nullable|string|unique:profiles,photo_path|url'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.max' => 'Your full name should not be longer than 100 characters.',
            'age.integer' => 'Age must be a number.',
            'age.min' => 'Age must be at least 18.',
            'age.max' => 'Age must be less than 100.',
            'city.max' => 'City should not be longer than 100 characters.',
            'info.max' => 'About Me should not be longer than 500 characters.',
            'photo_path.unique' => 'Photo path must be unique.',
            'photo_path.url' => 'Photo path must be a valid URL.'
        ];
    }
}

