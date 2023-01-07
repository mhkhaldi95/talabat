<?php

namespace App\Http\Resources\Website;

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
            'id' => $this->id,
            'address' => $this->address,
            'instagram_link' => $this->instagram_link,
            'twitter_link' =>$this->twitter_link,
            'facebook_link' =>$this->facebook_link,
            'status' => $this->status,
            'lat' =>$this->lat,
            'lng' =>$this->lng,
            'coordinate' =>'@'.$this->lng.','.$this->lat.',10z',
            'user' => new UserResource($this->user),
        ];
    }
}
