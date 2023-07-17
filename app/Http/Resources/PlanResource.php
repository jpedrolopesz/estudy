<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

class PlanResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'price_currency' => $this->price_currency,
            'deleted_at' => $this->deleted_at,
            'plan_features' => $this->planFeatures
        ];
    }
}
