<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
//    protected $appends =['name'];
    const FILLABLE = ['name','code','discount','type','days'
        ,'max_uses','times_used','valid_from','valid_to','deleted_at'];

    protected $fillable = self::FILLABLE;
    const COL_ORDERS = [];
    public function scopeFilter($q){
        $query = @request('search')['regex'];
        $value = @request('search')['value'];
        if($query == 'search'){
            return $q->whereRaw("concat(name, ' ',code) like '%" . $value . "%' ");
        }
        return $q;
    }


}
