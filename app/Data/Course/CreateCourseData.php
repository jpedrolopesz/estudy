<?php

namespace App\Data\Course;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class CreateCourseData extends Data
{
    public string $title;

    public string $description;

    public string $thumbnail;


    public static function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'thumbnail' => [
                'required', 'string',
            ],
        ];
    }
}
