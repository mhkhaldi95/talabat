<?php

namespace App\Http\Resources\UserManagement\Roles;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        dd($this);
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'permissions' =>  $this->permissions()->get(),
            'user_count' =>  $this->users()->count(),
        ];
    }
}
