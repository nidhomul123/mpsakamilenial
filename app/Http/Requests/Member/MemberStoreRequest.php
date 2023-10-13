<?php

namespace App\Http\Requests\Member;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class MemberStoreRequest extends FormRequest
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
            'image' => 'required|max:1024|image|mimes:svg,jpeg,jpg,png,gif,webp',
            'card' => 'required|max:1024|image|mimes:svg,jpeg,jpg,png,gif,webp',
            'email' => 'required|string|email|max:255|unique:' . Member::class,
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
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
