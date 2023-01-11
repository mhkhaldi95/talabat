<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $appends =['name'];
    protected $guarded = [];
    const COL_ORDERS = [];
    public function scopeFilter($q){
        $query = @request('search')['regex'];
        $value = @request('search')['value'];
        if($query == 'search'){
            return $q->whereRaw("concat(name_ar, ' ',name_en) like '%" . $value . "%' ");
        }
        return $q;
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute(){
        if(app()->getLocale() == 'ar'){
            return $this->name_ar;
        }
        return $this->name_en;

    }
}