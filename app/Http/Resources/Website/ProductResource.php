<?php

namespace App\Http\Resources\Website;

use App\Constants\Enum;
use App\Http\Resources\Products\AddonResource;
use App\Http\Resources\Products\PhotoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'discount_option' => $this->discount_option,
            'cashback' => $this->cashback,
            'qty' => $this->discount_option,
            'discounted_price' => $this->discounted_price,
            'max_addons' => $this->max_addons,
            'master_photo' => @$this->avatar,
            'product_addons' => AddonResource::collection($this->addons)->resolve(),
            'photos' => PhotoResource::collection($this->photos)->resolve(),
            'has_photo' => count($this->photos)>0,
            'tags' => $this->tags?(json_encode(convertTagsStringToObject($this->tags))):'',
            'status' => $this->status,
            'price_after_discount' => $this->price_after_discount == $this->price? $this->price:$this->price_after_discount,

        ];
    }
}
