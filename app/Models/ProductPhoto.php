<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPhoto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = ['photo_path'];
    public function getPhotoPathAttribute(){
        return asset('storage/product-photos/'.$this->name);
    }
}
