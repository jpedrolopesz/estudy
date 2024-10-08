<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'owner' => 'nullable',
            'password' => 'nullable',
            'password_' => 'nullable|required_if:email,null',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'photo' => 'sometimes|nullable',

        ];
    }
}
