<?php

namespace App\Data\Course;

use App\Rules\CourseDateMatchesTaskDates;
use Spatie\LaravelData\Data;

class UpdateCourseData extends Data
{
    public ?string $name;

    public ?string $description;

    public ?string $color;

    public ?string $icon;

    public ?string $start_date;

    public ?string $due_date;

    public ?array $members;

    public string $source = 'partial';

    public static function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:100'],
            'description' => ['sometimes', 'required', 'string'],
            'members' => ['sometimes', 'required', 'array', 'min:1'],
            'icon' => ['sometimes', 'required', 'string'],
            'color' => ['sometimes', 'required', 'string'],
            'source' => ['sometimes', 'required', 'string', 'in:full,partial'],
            'start_date' => ['sometimes', 'nullable', 'date',
                new CourseDateMatchesTaskDates(request()->course),
            ],
            'due_date' => ['sometimes', 'nullable', 'date',
                'after_or_equal:start_date',
                new CoursetDateMatchesTaskDates(request()->course),
            ],
        ];
    }
}
