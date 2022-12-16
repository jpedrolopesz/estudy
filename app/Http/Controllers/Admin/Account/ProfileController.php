<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfile;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function show()
    {
        return Inertia::render('Admin/Account/Profile/Show',
            ['user' => auth()->user()]);
    }


    public function update(UpdateProfile $request)
    {
        auth()->user()->update($request->all());
        if( $request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120)->save(public_path('storage/user/' . $filename));
            auth()->user()->image = $filename;
            auth()->user()->save();
        }

        return redirect()->back();
    }
}
