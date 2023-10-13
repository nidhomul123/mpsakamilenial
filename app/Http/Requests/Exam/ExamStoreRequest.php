<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamStoreRequest extends FormRequest
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
            'grade_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'time' => ['required'],
            'information' => ['required'],
            'passing_grade' => ['required'],
            'multiple_choice' => ['required'],
            'essay' => ['required'],
        ];
    }
}
