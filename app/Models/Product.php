<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    const FILLABLE = ['name_ar','name_ar','description_ar'
        ,'description_en','master_photo','tags','price','category_id','discounted_price','max_addons','discount_option','status'];

    protected $fillable = self::FILLABLE;
    protected $appends =['name','description','avatar'];
    const COL_ORDERS = [
        '2' =>'price',
        '3' =>'status',
    ];
    public function scopeFilter($q){
        $query = @request('search')['regex'];
        $value = @request('search')['value'];
        if($query == 'search'){
            return $q->whereRaw("concat(name_ar, ' ',name_en, ' ',description_ar, ' ',description_en, ' ',tags) like '%" . $value . "%' ");
        }
        if($query == 'status' && $value !=''){
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
        if(app()->getLocale() == 'ar'){
            return $this->description_ar;
        }
        return $this->description_en;

    }

    public function getAvatarAttribute(){
        if($this->master_photo == 'default.png'){
            return asset('assets/media/default.png');
        }
        return asset('storage/product-photos/'.$this->master_photo);
    }


}
