<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Stripe;

class RegisteredUserSubscriptionController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return Response
     */
    public function create(Request $request, $id): Response
    {
        // $stripekey = Cashier::stripe(['api_key' => config('cashier.secret')]);


        return Inertia::render('Auth/RegisterSubscription', [
            'plan' =>   Plan::findOrFail($id),
            'stripekey' => config('cashier.key'),
            'intent' => $request->user() ? $request->user()->createSetupIntent() : null
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

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * @throws ValidationException
     */
    public function paySubscription(Request $request): RedirectResponse
    {
        $plan = Plan::findOrFail($request->input('billing_plan_id'));


        $request->user()->newSubscription('default', $plan->stripe_id)
            ->create($request->paymentMethod['id']);


        return redirect()->back()
            ->with('success', 'Your data has been successfully updated.');
    }


}
