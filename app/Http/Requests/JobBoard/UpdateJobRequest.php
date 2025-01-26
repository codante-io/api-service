<?php

namespace App\Http\Requests\JobBoard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'max:255'],
            'company' => ['sometimes', 'string', 'max:255'],
            'company_website' => ['sometimes', 'url'],
            'city' => ['sometimes', 'string', 'max:255'],
            'schedule' => ['sometimes', 'string', 'in:full-time,part-time'],
            'salary' => ['sometimes', 'numeric'],
            'description' => ['sometimes', 'string'],
            'requirements' => ['sometimes', 'string'],
            'number_of_positions' => ['sometimes', 'integer'],
        ];
    }
}
