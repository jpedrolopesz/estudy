<?php

namespace App\Actions\User;

use App\Http\Requests\User\ProfileCreateRequest;
use App\Models\User;
use Intervention\Image\Facades\Image;

class CreateUserAction
{
    public function execute(ProfileCreateRequest $request): void
    {
        $user = new User();
        $user->fill($request->validated());

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');

            $filename = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120)->save(public_path('storage/user/' . $filename));
            $user->photo = $filename;
        }

        $user->save();
    }
}
