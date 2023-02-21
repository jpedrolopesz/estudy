<?php

namespace App\Http\Controllers\User\Account;

use App\Http\Controllers\Controller;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Laravel\Cashier\Subscription;

class PlanController extends Controller
{

    public function show()
    {


        return Inertia::render('User/Account/Plans/Show', [
            'plansMonthly' => Plan::where('slug', 'monthly')->get(),
            'plansYearly' =>  Plan::where('slug', 'yearly')->get(),
            'currentPlan' => auth()->user()->subscription('default')
        ]);

    }


}
