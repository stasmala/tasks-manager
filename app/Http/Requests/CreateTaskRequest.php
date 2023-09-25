<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'status' => 'required|in:todo,done',
            'priority' => 'required|integer',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
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
            'status.required' => 'The :attribute field is required.',
            'status.in' => 'The :attribute field must be "todo" or "done".',
            'priority.required' => 'The :attribute field is required.',
            'priority.integer' => 'The :attribute field must be an integer.',
            'title.required' => 'The :attribute field is required.',
            'title.string' => 'The :attribute field must be a string.',
            'description.string' => 'The :attribute field must be a string.',
            'parent_id.integer' => 'The :attribute field must be an integer.',
        ];
    }
}
