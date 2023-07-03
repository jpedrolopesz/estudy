<?php

namespace App\Http\Controllers\User\Account\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{

    public function cancel(Request $request): \Illuminate\Http\RedirectResponse
    {
        $subscription = auth()->user()->subscription('default');

        $subscription->cancel();

        return Redirect::back()->with('success', 'Your subscription has been canceled successfully');
    }

    public function resume(Request $request): \Illuminate\Http\RedirectResponse
    {
        $subscription = auth()->user()->subscription('default');

        $subscription->resume();

        return Redirect::back()->with('success', 'Your subscription has been successfully reactivated');
    }



}
