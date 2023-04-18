<?php

namespace App\Http\Resources;

use App\Enums\Roles;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $request->user();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => $user->photo,
            'username' => $this->username,
            'is_superadmin' => $this?->role == Roles::SUPER_ADMIN,
            'is_admin' => $this?->role == Roles::ADMIN,
            'is_active' => $this?->is_active,
            'role' => $this?->role->roleName(),
            $this->mergeWhen(Auth::check() && (Auth::id() == $this->id || Auth::user()->isAdminOrSuperAdmin()), [
                'status' => $this->status,
                'email' => $this->email,
            ]),

        ];
    }
}
