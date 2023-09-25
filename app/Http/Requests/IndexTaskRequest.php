<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
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
            'status' => 'nullable|in:todo,done',
            'priorityMin' => 'nullable|integer',
            'priorityMax' => 'nullable|integer',
            'title' => 'nullable|string',
            'sortBy' => 'nullable|in:priority,createdAt,completedAt',
            'sort' => 'nullable|in:asc,desc',
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
            'status.in' => 'The status can only be "todo" or "done".',
            'priorityMin.integer' => 'The minimum priority value should be an integer.',
            'priorityMax.integer' => 'The maximum priority value should be an integer.',
            'title.string' => 'The title should be a string.',
            'sortBy.in' => 'The sorting field can only be "priority", "createdAt", or "completedAt".',
            'sort.in' => 'The sorting direction can only be "asc" or "desc".',
        ];
    }
}
