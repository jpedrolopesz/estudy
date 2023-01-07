<?php

namespace App\Http\Controllers\User\Account;

use App\Http\Controllers\Controller;

use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Laravel\Cashier\Subscription;

class PlanController extends Controller
{
    public $plan = '';

    public function show(Subscription $subscription, Request $request,Plan $plan)
    {

        return Inertia::render('User/Account/Plans/Show', [
            'plansMonthly' => Plan::where('slug', 'monthly')->get(),
            'plansYearly' =>  Plan::where('slug', 'yearly')->get(),
            'currentPlan' => auth()->user()->subscription('default') ?? NULL
             // dd($request->user()->subscribed('default')),

        ]);

    }





    /**
    public function view(Request $request)
    {
        $plans = tenancy()->central(function () use($request) {

            return Plan::where('slug', '!=', tenant())->get();
        });

        return view('tenant.pages.account.plans.index', compact('plans'));
    }
     *
     **/




}
