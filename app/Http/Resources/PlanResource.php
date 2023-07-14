<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

class PlanResource extends JsonResource
{
    public function toArray($request)
    {
        $currencySymbol = 'USD'; // Obtenha o símbolo da moeda com base em $this->price_currency

        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        $formattedPrice = $formatter->formatCurrency($this->price, $currencySymbol);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $formattedPrice,
            'deleted_at' => $this->deleted_at,
            'plan_features' => $this->planFeatures
        ];
    }
}
