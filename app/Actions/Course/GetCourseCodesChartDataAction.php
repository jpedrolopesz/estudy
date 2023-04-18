<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Models\User;
use App\Support\Chart;

class GetCourseCodesChartDataAction
{
    public static function run(User $user, Course $course, string $field, string $type, array $filters)
    {
        $daterange = isset($filters['period'])
            ? Chart::resolvePeriod($filters['period'])
            : [];

        $query = $course->tasks()
            ->withoutGlobalScopes()
            ->join('codes', "tasks.{$field}", '=', 'codes.id')
            ->where('codes.type', $type)
            ->where('codes.course_id', $course->id)
            ->when(isset($filters['assigned_to_me']) && $filters['assigned_to_me'] == 'true', fn($builder) => $builder->where('tasks.assignee_id', $user->id))
            ->when(isset($filters['reported_by_me']) && $filters['reported_by_me'] == 'true', fn($builder) => $builder->where('tasks.reporter_id', $user->id))
            ->when(isset($filters['period']) && $filters['period'] !== 'all', fn($builder) => $builder->whereDateBetween('tasks.created_at', $daterange[0], $daterange[1]))
            ->groupBy('codes.display')
            ->groupBy('codes.color')
            ->select('codes.display as label', 'codes.color', \DB::raw('count(tasks.id) as total'))
            ->get();

        return [
            'labels' => $query->pluck('label')->toArray(),
            'series' => $query->pluck('total'),
            'colors' => $query->pluck('color')->map(fn($color) => Chart::colorMap[$color]),
        ];
    }
}
