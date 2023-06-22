<?php

namespace App\Http\Controllers\Admin;

use App\Actions\User\CreateUserAction;
use App\Actions\User\GetAllUsersAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileCreateRequest;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Response;
use Inertia\ResponseFactory;


class UsersController extends Controller
{

    public function index(): \Inertia\Response
    {
        $users = GetAllUsersAction::run(['perPage' => 10000]);

        return Inertia::render('Admin/User/Index', [
            'users' => UserResource::collection($users),
        ]);


    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/User/Create');
    }


    public function store(ProfileCreateRequest $request, User $user): RedirectResponse
    {

         (new CreateUserAction())->execute($request);

        return Redirect::route('user.index')->with('success', 'Successfully created');
    }

    public function edit(User $user): Response
    {

        return Inertia::render('Admin/User/Edit', [
            'user' => new UserResource($user),
            'invoices' => $user->invoices(),
            'subscription' => $user,

        ]);
    }

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {

        (new UpdateUserAction())->execute($request);


        return redirect()->back()->with('success', 'Successfully updated');
    }

    public function updatePassword(Request $request, User $user): RedirectResponse
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


    public function destroy(User $user): RedirectResponse
    {

        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }


}
