<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // allow authenticated users
        return auth()->check();
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']
        ];
    }

    /**
     * Optional: custom validation messages
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The blog title is required.',
            'description.required' => 'The blog description is required.'
        ];
    }

    /**
     * Optional: sanitize input
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => trim($this->title)
        ]);
    }
}
