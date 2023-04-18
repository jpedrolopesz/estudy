<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Models\User;
use App\Support\Chart;

class GetCourseTaskAssignmentChartDataAction
{
    public static function run(User $user, Course $course, string $field, array $filters)
    {
        $daterange = isset($filters['period'])
            ? Chart::resolvePeriod($filters['period'])
            : [];

        $query = $course->tasks()
            ->leftJoin('users', "tasks.{$field}", '=', 'users.id')
            ->groupBy(\DB::raw("CASE WHEN users.id IS NULL THEN 'Unassigned' ELSE CONCAT(users.first_name, ' ', users.last_name) END"))
            ->when(isset($filters['assigned_to_me']) && $filters['assigned_to_me'] == 'true' ?? null, fn($builder) => $builder->where('tasks.assignee_id', $user->id))
            ->when(isset($filters['reported_by_me']) && $filters['reported_by_me'] == 'true' ?? null, fn($builder) => $builder->where('tasks.reporter_id', $user->id))
            ->when(isset($filters['period']) && $filters['period'] !== 'all', fn($builder) => $builder->whereDateBetween('tasks.created_at', $daterange[0], $daterange[1]))
            ->select(\DB::raw("CASE WHEN users.id IS NULL THEN 'Unassigned' ELSE CONCAT(users.first_name, ' ', users.last_name) END as name"), \DB::raw('count(tasks.id) as total'))
            ->get();

        return [
            'labels' => $query->pluck('name')->toArray(),
            'series' => $query->pluck('total'),
        ];
    }
}
