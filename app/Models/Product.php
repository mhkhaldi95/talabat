<?php

namespace App\Models;

use App\Constants\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    const FILLABLE = ['name_ar','name_en','description_ar'
        ,'description_en','master_photo','tags','price','category_id','discounted_price','max_addons','discount_option','status'];

    protected $fillable = self::FILLABLE;
    protected $appends =['name','description','avatar','price_after_discount'];
    const COL_ORDERS = [
        '2' =>'price',
        '3' =>'status',
    ];
    public function scopeFilter($q){

        if(!Auth::check() || Auth::user()->role == Enum::CUSTOMER){
            $col = 'search';
            $value = @request('search');
        }else{
            $col = @request('search')['regex'];
            $value = @request('search')['value'];
        }
        if($col == 'search'){
            $q->when(true,function ($qq) use ($value){
                return $qq->whereRaw("concat(name_ar, ' ',name_en, ' ',description_ar, ' ',description_en) like '%" . $value . "%' ")
                    ->orWhere('tags','like',"%$value%");
            });

        }
        if($col == 'status' && $value !=''){
            return $q->where("status",$value);
        }
        return $q;
    }

    public function addons(){
        return $this->belongsToMany(Addon::class,'product_addons');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(ProductPhoto::class);
    }

    public function getNameAttribute(){
        if(app()->getLocale() == 'ar'){
            return $this->name_ar;
        }
        return $this->name_en;

    }
    public function getDescriptionAttribute(){
        $points = strlen($this->description_ar)>90?' ...':'';
        if(app()->getLocale() == 'ar'){
            return substr($this->description_ar,0,90).$points;
        }
        return  substr($this->description_en,0,90).$points;

    }

    public function getAvatarAttribute(){
        if($this->master_photo == 'default.png'){
            return asset('assets/media/default.png');
        }
        return asset('storage/product-photos/'.$this->master_photo);
    }

    public function getPriceAfterDiscountAttribute(){
        $price_after_discount = $this->price;
        if($this->discounted_price){
            switch ($this->discount_option){
                case Enum::DISCOUNT_PERCENTAGE :
                    $price_after_discount = $this->price -  ($this->price * ($this->discounted_price/100));break;
                case Enum::DISCOUNT_FIXED :
                    $price_after_discount = $this->price -  $this->discounted_price;break;
            }
        }
        return $price_after_discount;
    }


}
