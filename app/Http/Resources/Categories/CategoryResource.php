<?php

namespace App\Http\Resources\Categories;

use App\Constants\Enum;
use App\Http\Resources\Website\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'status' => $this['status'],
            'products' => ProductResource::collection($this->products()->published()->get())->resolve(),
        ];
    }
}
