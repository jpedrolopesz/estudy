<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Payments\GetPaymentAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Cashier\Cashier;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return Response
     */
    public function create(Request $request): Response
    {

        return Inertia::render('Auth/Register', [
            'stripekey' => Cashier::stripe(['api_key' => config('cashier.secret')]),
            'intent' => $request->user() ? $request->user()->createSetupIntent() : null
        ]);

    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
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
}
