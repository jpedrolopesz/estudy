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
            'title' => 'required|string|max:55|min:4',
            'description' => 'nullable|string|max:255|min:10',
            //'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

}