<?php

namespace App\Http\Controllers\User\Account\Subscription;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionInvoiceController extends Controller
{
    public function show()
    {
        $onGracePeriod = false;
        if( auth()->user()->subscribed('default')) {
            $onGracePeriod = auth()->user()->subscription('default')->onGracePeriod();
        }

        return Inertia::render('User/Account/Invoices/Show', [
            'invoices' => auth()->user()->invoices(),
            'subscription' => auth()->user(),
            'onGracePeriod' => $onGracePeriod, //cancelou sua assinatura, mas ainda está em seu "período de carência"

        ]);

    }

    public function pdf(Request $request, $id)
    {
        $request = User::get();
        return redirect(
            $request($id)
                ->findInvoice($id)
                ->asStripeInvoice()
                ->invoice_pdf);
    }
}
