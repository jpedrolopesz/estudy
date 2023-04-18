<?php

namespace App\Actions\Code;

use App\Enums\CodeTypes;
use App\Http\Resources\CodeResource;
use App\Models\Project;

class GetProjectCodesAction
{
    public static function run(Project $project)
    {
        return [
            'type' => CodeResource::collection($project?->codes()->where('type', CodeTypes::TASK_TYPE)->get()),
            'priority' => CodeResource::collection($project?->codes()->where('type', CodeTypes::TASK_PRIORITY)->get()),
            'section' => CodeResource::collection($project?->codes()->where('type', CodeTypes::TASK_SECTION)->get()),
        ];
    }
}
