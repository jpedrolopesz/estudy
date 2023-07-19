<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserSubscriptionController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return Response
     */
    public function create(Request $request, $id): Response
    {
        $plan = Plan::findOrFail($id);

        return Inertia::render('Auth/RegisterSubscription', [
            'plan' => $plan,
            'stripekey' => config('cashier.key'),
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


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'trial_ends_at' => now()->addDays(config('cashier.trial_days')),
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back();
        }

        return redirect()->back();
    }


    /**
     * @throws ValidationException
     */
    public function paySubscription(Request $request): RedirectResponse
    {
        $plan = Plan::findOrFail($request->input('billing_plan_id'));

        $feature = $plan->planFeatures->max_users;
        $maxUsers = $feature;

        $request->user()->newSubscription('default', $plan->stripe_id)
            ->create($request->paymentMethod['id']);

        DB::table('subscriptions')
            ->where('user_id', $request->user()->id)
            ->update(['max_users' => $maxUsers]);

        return redirect()->back()
            ->with('success', 'Your data has been successfully updated.');
    }


    /**
     * @throws ValidationException
     */
    public function paySubscriptionUpdate(Request $request): RedirectResponse
    {
        $plan = Plan::findOrFail($request->input('billing_plan_id'));
        $feature = $plan->planFeatures->max_users;
        $maxUsers = $feature;

        $request->user()->subscription('default', $plan->stripe_id)->swapAndInvoice($request->plan);

        DB::table('subscriptions')
            ->where('user_id', $request->user()->id)
            ->update(['max_users' => $maxUsers]);

        return redirect()->route('course.user.index')->with('success', 'Your data has been successfully updated.');
    }



}
