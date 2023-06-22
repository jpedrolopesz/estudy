<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' =>$this->email,
            'photo' => $this->photo,
            'owner' => $this->owner,
            'deleted_at' => $this->deleted_at,
            'trial_ends_at' => $this->trial_ends_at

        ];
    }
}
