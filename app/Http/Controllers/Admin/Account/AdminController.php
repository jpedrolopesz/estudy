<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /**
     * Display the admin profile form.
     *
     * @param Request $request
     * @return Response
     */

    public function edit(Request $request): Response
    {
        return Inertia::render('Admin/Account/Profile/Edit',
            [
                'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
                'status' => session('status'),
                'user' => auth()->user()
            ]);
    }

    /**
     * Update the admin.
     *
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */

    public function update(ProfileUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->hasFile('photo')) {
            // Excluir imagem antiga
            $oldPhoto = $request->user()->photo;
            if (!empty($oldPhoto)) {
                $oldPhotoPath = public_path('storage/user/' . $oldPhoto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Salvar nova imagem
            $image = $request->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120)->save(public_path('storage/user/' . $filename));
            $request->user()->photo = $filename;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back()->with('success', 'Successfully updated');
    }
}
