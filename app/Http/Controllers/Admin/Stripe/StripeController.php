<?php

namespace App\Http\Controllers\Admin\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Invoice;
use Stripe\Customer;
use Stripe\Subscription;

class StripeController extends Controller
{


    public function show(Request $request)
    {

        $onGracePeriod = false;
        if( auth()->user()->subscribed('default')) {
            $onGracePeriod = auth()->user()->subscription('default')->onGracePeriod();
        }




        return Inertia('Admin/Stripe/Show',[

            'invoices' => auth()->user(),
            'user' => auth()->user(),
                //'plan' => $plan,
                'upcomingInvoice' => auth()->user()->upcomingInvoice(),
                'subscribed' => auth()->user()->subscribed('default'), // usuário tiver uma assinatura ativa, mesmo que a assinatura esteja atualmente dentro de seu período de avaliação
                'subscription' => auth()->user()->subscription('default'),// usuário tiver uma assinatura ativa, mesmo que a assinatura esteja atualmente dentro de seu período de avaliação
                'onGenericTrial' => auth()->user()->onGenericTrial(), //usuário está dentro de seu período de teste "genérico" e ainda não criou uma assinatura real
                'onGracePeriod' => $onGracePeriod, //cancelou sua assinatura, mas ainda está em seu "período de carência"


            ]
        );
    }



    public function create ()
    {
        return Inertia::modal('Admin/Stripe/Create')->baseRoute('stripe.create');
    }
}
