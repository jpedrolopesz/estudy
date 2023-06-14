<?php

namespace App\Actions\Payments;



class GetPaymentAction
{
    public static function run($id)
    {
        $intent = auth()->user()->createSetupIntent();
        return $intent;
    }
}


