<?php

namespace App\Http\Resources;

use App\Actions\Code\GetCourseCodesAction;
use App\Support\AuthorizationChecker;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'color' => $this->color,
            'code' => $this->code,
            'icon' => $this->icon,
            'start_date' => $this->start_date?->isoFormat('YYYY-MM-D'),
            'due_date' => $this->due_date?->isoFormat('YYYY-MM-D'),
            'is_archived' => $this->resource->isArchived(),
            'is_faved' => Auth::user()?->hasFavedCourse($this->resource),

        ];
    }
}
