<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Authorization
     */
    public function authorize(): bool
    {
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
     * Optional messages
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The blog title is required.',
            'description.required' => 'The blog description is required.'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => trim($this->title)
        ]);
    }
}
