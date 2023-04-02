<?php

namespace App\Models;

use App\Constants\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    const COL_ORDERS = [];
    protected $guarded = [];
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    public function calculateDiscount(){
        $coupon = $this->coupon;
        if($coupon){
            if($coupon->type == Enum::FIXED){
               return $coupon->discount;
            }else{
                return  ($this->price * ($coupon->discount/100)) ;
            }
        }

        return 0;
    }
    public function scopeFilter($q){
        $col = @request('search')['regex'];
        $value = @request('search')['value'];
        if($col == 'search'){
//            $q->when(true,function ($qq) use ($value){
//                return $qq->where('address','like',"%$value%")
//                    ->orWhereHas('user',function ($user) use ($value){
//                        return $user->whereRaw("concat(name, ' ',email, ' ',phone) like '%" . $value . "%' ");
//                    });
//            });
            $q->where('id','like',"%$value%");

        }
        if($col == 'status' && $value !=''){
             $q->where("status",$value);
        }
        if($col == 'user_id' && $value !=''){
           $q->whereHas('user',function ($user) use ($value){
                 $user->where("users.id",$value);
            });
        }
        return $q;
    }


}
