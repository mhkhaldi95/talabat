<?php

namespace App\Http\Resources\UserManagement\Branches;

use App\Http\Resources\UserManagement\Admins\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => view('dashboard.user_management.branches.partial.datatable_cols._id',[
                'item' => $this
            ])->render(),
            'address' => $this->address,
            'instagram_link' => $this->instagram_link,
            'twitter_link' =>$this->twitter_link,
            'facebook_link' =>$this->facebook_link,
            'status' => view('dashboard.user_management.branches.partial.datatable_cols._status',[
                'item' => $this
            ])->render(),
            'lat' =>$this->lat,
            'lng' =>$this->lng,
            'user' => new UserResource($this->user),
            'actions' => view('dashboard.user_management.branches.partial.datatable_cols._action',[
                'item' => $this
            ])->render(),
        ];
    }
}
