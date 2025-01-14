<?php

namespace App\Http\Requests\JobBoard;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'company_website' => ['required', 'url'],
            'city' => ['required', 'string', 'max:255'],
            'schedule' => ['required', 'string', 'in:full-time,part-time'],
            'salary' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
        ];
    }
}
