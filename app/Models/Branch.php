<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;
    const FILLABLE = ['address','instagram_link','twitter_link'
        ,'facebook_link','status','lat','lng','deleted_at','user_id'];
    const COL_ORDERS = [];

    protected $fillable = self::FILLABLE;


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($q){
        $col = @request('search')['regex'];
        $value = @request('search')['value'];
        if($col == 'search'){
            $q->when(true,function ($qq) use ($value){
                return $qq->where('address','like',"%$value%")
                    ->orWhereHas('user',function ($user) use ($value){
                        return $user->whereRaw("concat(name, ' ',email, ' ',phone) like '%" . $value . "%' ");
                    });
            });

        }
        if($col == 'status' && $value !=''){
            return $q->where("status",$value);
        }
        return $q;
    }
}
