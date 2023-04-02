<?php

namespace App\Http\Resources\Orders;

use App\Constants\Enum;
use App\Http\Resources\Website\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'branch' => @$this->branch->address,
            'user' => @$this->user->name,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'status' => view('dashboard.orders.partial.datatable_cols._status',[
                'item' => $this,
            ])->render(),
            'actions' => view('dashboard.orders.partial.datatable_cols._action',[
                'item' => $this,
            ])->render(),
        ];
    }
}