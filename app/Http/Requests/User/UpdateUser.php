<?php

namespace App\Http\Requests\User;

use App\Rules\CurrentPasswordUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255',],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],           'avatar' => ['nullable'],
            'password' => ['nullable', 'min:6', 'max:15'],
            'password_current' => ['nullable', new CurrentPasswordUser()],
            'image' => ['nullable'],
            'country' => ['nullable'],
            'street_address' => ['nullable'],
            'state_province' => ['nullable'],
            'city' => ['nullable'],
            'zip_code' => ['nullable'],
        ];
    }
}
