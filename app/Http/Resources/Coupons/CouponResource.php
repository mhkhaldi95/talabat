<?php

namespace App\Http\Resources\Coupons;

use App\Constants\Enum;
use App\Http\Resources\Website\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'id' => $this['id'],
            'name' => $this['name'],
            'code' => $this['code'],
            'type' => $this['type'],
            'discount' => $this['discount'],
            'max_uses' => $this['max_uses'],
            'times_used' => $this['times_used'],
            'valid_from' => $this['valid_from'],
            'days' => $this['days'],
            'valid_to' => $this['valid_to'],
        ];
    }
}
