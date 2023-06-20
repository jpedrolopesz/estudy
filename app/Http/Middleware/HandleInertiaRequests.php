<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Laravel\Cashier\Subscription;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {

        return array_merge(parent::share($request), [

            'auth' => function () use ($request) {
                $user = auth()->user();
                $isSubscribed = $user ? $user->subscribed('default') : false;
                $subscription = null ?  $user->subscription('default') : false;

                if ($subscription) {
                    return [
                        'user' => $user,

                        'subscription_status' => match (true) {
                            $subscription->onTrial() => 'trial',
                            $subscription->recurring() => 'active',
                            $subscription->canceled() => 'canceled',
                            $subscription->onGracePeriod() => 'grace_period',
                            $subscription->ended() => 'ended',
                            default => null,
                        },
                        'is_subscribed' => $isSubscribed,

                    ];
                } else {
                    return [
                        'user' => $user,
                        'is_subscribed' => null,
                        'subscription_status' => null,
                    ];
                }
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'alert' => $request->session()->get('alert'),
                    'error' => $request->session()->get('error'),
                ];
            },

        ]);
    }
}
