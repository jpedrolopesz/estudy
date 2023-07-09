<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateCourseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    function rules(): array
    {
        return [
            'user_id' => 'nullable',
            'title' => 'required|string|max:60|min:4',
            'description' => 'nullable|string|max:255|min:10',
            'thumbnail' => 'required|nullable|sometimes|mimes:jpeg,png,jpg|max:2048',
        ];
    }

}
