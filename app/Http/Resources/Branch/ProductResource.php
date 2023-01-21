<?php

namespace App\Http\Resources\Branch;

use App\Constants\Enum;
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
        $product_branch_status = auth()->user()->branch?auth()->user()->branch->productStatus($this->id):null;
        return [
            'id' => view('branch.products.partial.datatable_cols._id',[
                'item' => $this
            ])->render(),
            'name' => view('branch.products.partial.datatable_cols._name',[
                'item' => $this
            ])->render(),
            'descriptiion' => $this->descriptiion,
            'price' =>  view('branch.products.partial.datatable_cols._price',[
                'item' => $this
            ])->render(),
            'avatar' => $this->avatar,
            'category' => $this->category->name,
            'actions' => view('branch.products.partial.datatable_cols._action',[
                'item' => $this,
                'product_branch_status' => $product_branch_status,
            ])->render(),
            'product_branch_status' => view('branch.products.partial.datatable_cols._status',[
                'item' => $this,
                'product_branch_status' => $product_branch_status
            ])->render(),

            'status' => view('branch.products.partial.datatable_cols._status',[
                'item' => $this
            ])->render(),
            'price_after_discount' => $this->price_after_discount == $this->price? $this->price:$this->price_after_discount,

        ];
    }
    public function toShow(){
        return [
            'id' => $this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->name,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'discount_option' => $this->discount_option,
            'discounted_price' => $this->discounted_price,
            'max_addons' => $this->max_addons,
            'master_photo' => $this->avatar,
            'product_addons' => @$this->addons->pluck('id')->toArray(),
            'photos' => @$this->photos()->select('id','name')->get(),
            'tags' => $this->tags?(json_encode(convertTagsStringToObject($this->tags))):'',
            'status' => $this->status,
            'product_branch_status' => auth()->user()->branch?auth()->user()->branch->productStatus($this->id):null,
            'price_after_discount' => $this->price_after_discount == $this->price? $this->price:$this->price_after_discount,

        ];
    }
    public function toWebSite(){
        return [
            'id' => $this['id'],
            'name' => $this->name,
            'description' => $this->description,
            'photos' => @$this->photos()->select('id','name')->get(),
            'master_photo' => $this->avatar,
            'price' => $this->price,
            'price_after_discount' => $this->price_after_discount == $this->price? $this->price:$this->price_after_discount,
            ];
    }
}
