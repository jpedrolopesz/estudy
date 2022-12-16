<?php

namespace App\Http\Controllers\User\Account\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends Controller
{

    //Checkout
    public function subscription(User $user,Request $request, $plan_id)
    {

        return Inertia('Subscription/Show',
            [
                'stripeKey' => config('cashier.key'),
                'intent'=> $user->createSetupIntent(),
                'plan' => Plan::findOrFail($plan_id)

            ],
          );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function processSubscription(Request $request)
    {

        dd($request->all());

        $this->validate($request, [
            'token' => 'required',
        ]);

        $plan = tenancy()->central(function () use($request){
            return Plan::findOrFail($request->input('billing_plan_id'));
        });

        try {
            tenant()
                ->newSubscription('default', $plan->stripe_id)
                ->create($request->token);
        } catch (IncompletePayment $e) {
            return redirect()->route('cashier.payment',
                [$e->payment->id,
                    'redirect' => route('tenant.pages.account.profile.index')
                ]);

        }

        return redirect()->route('tenant.account.plans.index')
            ->with('success', 'Your data has been successfully updated.');
    }


}
