<?php

namespace App\Data\Modules;

use Spatie\LaravelData\Data;

class CreateModuleData extends Data
{
    public string $id;

    public string $title;

    public string $order;


    public static function rules(): array
    {
        return [
            'course_id' => ['id'],
            'title' => ['required', 'string', 'max:100'],
            'order' => ['nullable'],
        ];
    }
}
