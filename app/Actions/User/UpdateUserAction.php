<?php

namespace App\Actions\User;

use App\Http\Requests\User\ProfileUpdateRequest;
use App\Models\User;
use Intervention\Image\Facades\Image;

class UpdateUserAction
{
    public function execute(ProfileUpdateRequest $request): void
    {
        $user = User::findOrFail($request->input('id'));

        $user->fill($request->validated());

        if ($request->hasFile('photo')) {
            $oldPhoto = $user->photo;
            if (!empty($oldPhoto)) {
                $oldPhotoPath = public_path('storage/user/' . $oldPhoto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $image = $request->file('photo');

            $filename = $request->user()->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120)->save(public_path('storage/user/' . $filename));
            $user->photo = $filename;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();


    }
}
