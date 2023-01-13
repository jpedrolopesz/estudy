<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class PasswordAdminController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return Response
     */
    public function edit(): Response
    {
        return Inertia::render('Admin/Account/Password/Edit',
            ['status' => session('status')]);
    }

    /**
     * Update the user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {


        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);


        return Redirect::back()->with('success', 'Successfully updated');
    }
}
