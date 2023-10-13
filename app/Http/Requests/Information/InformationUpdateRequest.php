<?php

namespace App\Http\Requests\Information;

use Illuminate\Foundation\Http\FormRequest;

class InformationUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'image' => 'nullable|max:2048|image|mimes:svg,jpeg,jpg,png,gif,webp',
            'text' => ['required', 'string'],
            'date' => ['required'],
            'published' => ['required', 'in:1,0'],
        ];
    }
}
