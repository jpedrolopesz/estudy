<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CreateModuleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

   function rules(): array
   {
       return [
           'id' => 'required|numeric',
           'title' => 'required|string|max:55|min:4',
           'description' => 'nullable|string|max:255|min:1',
       ];
   }

}
