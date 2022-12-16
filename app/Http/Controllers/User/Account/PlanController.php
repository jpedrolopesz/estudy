<?php

namespace App\Http\Controllers\User\Account;

use App\Http\Controllers\Controller;

use App\Http\Middleware\EnsureUserIsSubscribed;
use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Cashier\Exceptions\IncompletePayment;

class PlanController extends Controller
{
    public $plan = '';

    public function show()
    {

        return Inertia::render('User/Account/Plans/Show', [
            'EnsureUserIsSubscribed' => EnsureUserIsSubscribed::class,
            'plansMonthly' => Plan::where('slug', 'monthly')->get(),
            'plansYearly' =>  Plan::where('slug', 'yearly')->get()
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

    public function  store(Request $request)
    {
        $plan = tenancy()->central(function () use($request) {

            return Plan::where('slug', $request->plan_id)->first();

        });
        try {
            tenant()->subscription('default')->swapAndInvoice($request->plan);
        } catch (IncompletePayment $e) {
            return redirect()->route('cashier.payment',
                [$e->payment->id,
                    'redirect' => route('tenant.pages.account.plans.index')
                ]);

        }
        return back();
    }
     *
     **/


}
