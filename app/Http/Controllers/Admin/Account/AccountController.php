<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function show()
    {
        return inertia ('Admin/Account/Show');
    }
}
