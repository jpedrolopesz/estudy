<?php

namespace App\Http\Controllers\User\Account\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends Controller
{

    //Checkout
    public function subscription($plan_id)
    {

        $plan = Plan::findOrFail($plan_id);

        return view('pages.checkout', [
            'plan' => $plan,
            'intent' => auth()->user()->createSetupIntent(),
            'currentPlan' => auth()->user()->subscription($plan->name) ?? NULL,

        ]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function processSubscription(Request $request)
    {

        $this->validate($request, [
            'token' => 'required',
        ]);


        $plan = Plan::findOrFail($request->input('billing_plan_id'));
        try {
           auth()->user()
                ->newSubscription('default' ,$plan->stripe_id)
                ->create($request->token);

        } catch (IncompletePayment $e) {
            return redirect()->route('cashier.payment',
                [$e->payment->id,
                    'redirect' => route('plans.show')
                ]);

        }

        return redirect('plans')
            ->with('success', 'Your data has been successfully updated.');
    }




    public function update(Request $request)
    {

        $plan = Plan::where('slug', $request->plan_id)->first();

        try {
            auth()->user()->subscription('default')->swapAndInvoice($request->plan);
        } catch (IncompletePayment $e) {
            return redirect()->route('cashier.payment',
                [$e->payment->id,
                    'redirect' => route('plans.show')
                ]);

        }

        return redirect('plans')
            ->with('success', 'Your data has been successfully updated.');
    }

    public function cancel(Request $request)
    {
        $subscription = auth()->user()->subscription('default');

        $subscription->cancel();

        return Redirect::back()->with('success', 'Your subscription has been canceled successfully');
    }

    public function resume(Request $request)
    {
        $subscription = auth()->user()->subscription('default');

        $subscription->resume();

        return Redirect::back()->with('success', 'Your subscription has been successfully reactivated');
    }



}
