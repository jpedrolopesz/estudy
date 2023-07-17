<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePlanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => "required|min:3|max:255|",
            'description' => 'nullable|min:3|max:255',
            'price' => "required",
            'price_currency' => "required",
            'max_users' => 'required|numeric',
        ];
    }
}
