<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateLessonRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    function rules(): array
    {
        return [
            'module_id' => 'required|numeric',
            'title' => 'required|string|max:55|min:4',
            'description' => 'nullable|string|max:255|min:10',
        ];
    }

}
