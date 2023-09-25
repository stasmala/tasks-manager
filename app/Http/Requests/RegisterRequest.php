<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute field must be a string.',
            'name.max' => 'The :attribute field must not exceed :max characters.',
            'email.required' => 'The :attribute field is required.',
            'email.string' => 'The :attribute field must be a string.',
            'email.email' => 'The :attribute field must be a valid email address.',
            'email.unique' => 'The :attribute has already been taken.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute field must be a string.',
            'password.min' => 'The :attribute field must be at least :min characters.',
            'password.confirmed' => 'The :attribute confirmation does not match.',
        ];
    }
}
