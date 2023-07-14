<?php

namespace App\Actions\Plan;

use App\Models\Plan;
use App\Data\Plan\PlanFilterData;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Pipeline;
use NumberFormatter;

class GetAllPlansAction
{
    public static function run(array $filters = [])
    {
        $data = PlanFilterData::from([
            'builder' => Plan::query(),
            'filters' => $filters,
        ]);

        return Pipeline::send($data)
            ->then(fn ($data) => $data->builder)
            ->filter(Request::only('search', 'trashed'))
            ->paginate(6)
            ->withQueryString()
            ->tap(function ($results) {
                $results->getCollection()->transform(function ($plan) {
                    $currencySymbol = ''; // Obtenha o símbolo da moeda com base em $plan->price_currency

                    $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
                    $formattedPrice = $formatter->formatCurrency($plan->price, $currencySymbol);

                    $plan->formattedPrice = $formattedPrice;

                    return $plan;
                });
            });
    }
}
