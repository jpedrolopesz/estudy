<?php

namespace App\Http\Requests\User;

use App\Rules\CurrentPasswordUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasswordUser extends FormRequest
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
            'password_current' => ['required', new CurrentPasswordUser()],
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
