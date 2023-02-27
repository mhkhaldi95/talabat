<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBranch;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request){


    }
    public function store(Request $request){
        if($this->checkQtyInCart()['status']){
            return response()->json([
                'status' => false,
                'message' => $this->checkQtyInCart()['msg']
            ]);
        }
        dd($request->all());
    }
    public function checkQtyInCart(){
        $cart = session()->get('cart');
        $msg = '';
        foreach ($cart as $cart_item){
            $item =  ProductBranch::query()->where('branch_id',$this->branch->id)->where('product_id',$cart_item['id'])->firstOrFail();
            $status = false;
            if($item){
                if($item->qty < $cart_item['quantity']);{
                    $msg.='  الكمية المطلوبة غير متوفرة: '.$cart_item['name'].'<br/>';
                    $status = true;
                }
            }

        }
        return  ['status' => $status,'msg' => $msg];

    }
}
