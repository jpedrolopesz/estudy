<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Inertia\Inertia;

class WebsiteController extends Controller
{
    public function index(): \Inertia\Response
    {


        return Inertia::render('Home/Welcome',[
            'plans' => Plan::all(),
            'plansMonthly' =>
                PlanFeature::join('plans', 'plan_features.plan_id', '=', 'plans.id')
                ->where('plans.slug', 'monthly')
                ->get(),
            'plansYearly' =>
                PlanFeature::join('plans', 'plan_features.plan_id', '=', 'plans.id')
                    ->where('plans.slug', 'yearly')
                    ->get(),
        ]);
    }



    public function presentation(): \Inertia\Response
    {
        return Inertia::render('Presentation');
    }
}
