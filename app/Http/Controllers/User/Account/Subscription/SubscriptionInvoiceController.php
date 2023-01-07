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

        return Inertia::render('User/Account/Invoices/Show', [
            'invoices' => auth()->user()->invoices(),
            'subscription' => auth()->user(),
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
