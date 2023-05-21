<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateModuleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    function rules(): array
    {
        return [
            'id' => 'nullable|numeric',
            'title' => 'required|string|max:55|min:4',
            'description' => 'nullable|string|max:255|min:10',
        ];
    }

}
