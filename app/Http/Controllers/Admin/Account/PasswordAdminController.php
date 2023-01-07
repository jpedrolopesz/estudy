<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordUser;
use Inertia\Inertia;

class PasswordAdminController extends Controller
{
    public function edit()
    {
        return Inertia::render('Admin/Account/Password/Edit',
            ['user' => auth()->user()]);
    }

    public function update(PasswordUser $request)
    {
        auth()->user()->update([
            'password'=>bcrypt($request->password)
        ]);

        return redirect()->back();
    }
}
