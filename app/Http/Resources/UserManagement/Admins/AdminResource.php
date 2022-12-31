<?php

namespace App\Http\Resources\UserManagement\Admins;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'roles_str' =>$this->convertRolesToString($this->roles),
        ];
    }
    public function convertRolesToString($roles){
        $str = '';
        foreach ($roles as $role){
            $str .=$role->name.' -';
        }
        $str = rtrim($str, "-");
        if($str == ''){
            $str = __('lang.no_role');
        }
        return $str;
    }
}
