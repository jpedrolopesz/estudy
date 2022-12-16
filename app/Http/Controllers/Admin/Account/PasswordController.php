<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordUser;
use Inertia\Inertia;

class PasswordController extends Controller
{
    public function show()
    {
        return Inertia::render('Admin/Account/Password/Show',
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
