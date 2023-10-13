<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class MemberUpdateRequest extends FormRequest
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
            'grade_id' =>  'required',
            'name' => ['required', 'string', 'max:255'],
            'image' => 'nullable|max:1024|image|mimes:svg,jpeg,jpg,png,gif,webp',
            'card' => 'nullable|max:1024|image|mimes:svg,jpeg,jpg,png,gif,webp',
            'email' => 'required|unique:members,email,' . $this->member->id,
            'gender' => ['required','in:L,P'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required'],
            'gudep' => ['required', 'string', 'max:255'],
            'kwarran' => ['required', 'string', 'max:255'],
            'number_id' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'instagram' => ['required', 'string', 'max:255'],
            'password'  => ['nullable', 'confirmed', Password::defaults()],
            'password_confirmation' => 'sometimes|required_with:password|same:password',
        ];
    }
}
