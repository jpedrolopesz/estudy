<?php

namespace App\Http\Resources;

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

            'modules' => $this->when($this->resource->relationLoaded('modules'),
                $this->modules->map(fn($module) => [
                    'id' => $module->id,
                    'title' => $module->title,


                ]),

            ),

        ];
    }
}
