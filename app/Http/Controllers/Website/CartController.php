<?php

namespace App\Http\Controllers\Website;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBranch;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public  $branch = null;
    public  $product = null;
    public  $product_branch = null;
    public function __construct(Request $request)
    {
        try {
            $this->branch =  Branch::query()->findOrFail(intval($request->branch_id));
            if($request->product_id){
                $this->product = Product::query()->published()->findOrFail($request->product_id);
                $this->product_branch =  ProductBranch::query()->where('branch_id',$this->branch->id)->where('product_id',$this->product->id)->firstOrFail();

            }
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }

    }

    public function addToCart(Request $request)
    {
        $product_qty = $request->product_qty;
        $addon_ids = $request->get('addon_ids',[]);
        $qty_addons = $request->get('qty_addons',[]);
        $cart = session()->get('cart');

        if(!$this->product_branch){
            return  $this->response_json(false,StatusCodes::INTERNAL_ERROR,Enum::GENERAL_ERROR,[]);
        }
        // if cart is empty then this the first product
        if(!$cart) {
//            $this->product_branch->update(['qty' => $this->product_branch->qty - $product_qty]);
            $cart = [
                $this->product->id => [
                    "name" => $this->product->name,
                    "id" => $this->product->id,
                    "quantity" => $product_qty,
                    "addon_ids" => $addon_ids,
                    "qty_addons" => $qty_addons,
                    "price" => $this->product->price,
                    "photo" => count($this->product->photos)>0?$this->product->photos[0]->photo_path:$this->product->avatar
                ]
            ];

            session()->put('cart', $cart);
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY, view('website._cart',[
                'cart' =>session()->get('cart'),
                'branch' =>$this->branch,
            ])->render());
//            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$this->product->id]) && !$request->plus_one) {

//            $this->product_branch->update(['qty' => $this->product_branch->qty - $product_qty]);
            $cart[$this->product->id]['quantity'] += $product_qty;

            session()->put('cart', $cart);
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',[
                'cart' =>session()->get('cart'),
                'branch' =>$this->branch,
            ])->render());
//            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
//        $this->product_branch->update(['qty' => $this->product_branch->qty - 1]);
        $cart[$this->product->id] = [
            "name" => $this->product->name,
            "quantity" => $product_qty,
            "addon_ids" => $addon_ids,
            "qty_addons" => $qty_addons,
            "id" => $this->product->id,
            "price" => $this->product->price,
            "photo" => count($this->product->photos)>0?$this->product->photos[0]->photo_path:$this->product->avatar
        ];

        session()->put('cart', $cart);
        return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',[
            'cart' =>session()->get('cart'),
            'branch' =>$this->branch,
        ])->render());
//        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function minus(Request $request)
    {

        $product_qty = $request->product_qty;

        $cart = session()->get('cart');

//        $this->product_branch->update(['qty' => $this->product_branch->qty + 1]);

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$this->product->id] = [
            "name" => $this->product->name,
            "quantity" => $product_qty,
            "id" => $this->product->id,
            "price" => $this->product->price,
            "photo" => count($this->product->photos)>0?$this->product->photos[0]->photo_path:$this->product->avatar
        ];

        session()->put('cart', $cart);
        return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',[
            'cart' =>session()->get('cart'),
            'branch' =>$this->branch,
        ])->render());
//        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function remove(Request $request)
    {
        if($this->product) {
            $cart = session()->get('cart');
            if(isset($cart[$this->product->id])) {
                unset($cart[$this->product->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',[
                'cart' =>session()->get('cart'),
                'branch' =>$this->branch,
            ])->render());

        }
    }


//if($this->product_branch->qty == 0 || $this->product_branch->qty < $product_qty ){
//return response()->json([
//'status' => false,
//'message' => 'لا تتوفر الكمية المطلوبة'
//]);
//}
}
