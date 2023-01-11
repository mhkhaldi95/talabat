<?php

namespace App\Http\Controllers\Website;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $id = $request->product_id;
        $product_qty = $request->product_qty;
        $addon_ids = $request->get('addon_ids',[]);
        $qty_addons = $request->get('qty_addons',[]);
        try {
            $product = Product::query()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "id" => $product->id,
                    "quantity" => $product_qty,
                    "addon_ids" => $addon_ids,
                    "qty_addons" => $qty_addons,
                    "price" => $product->price,
                    "photo" => count($product->photos)>0?$product->photos[0]->photo_path:$product->avatar
                ]
            ];

            session()->put('cart', $cart);
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY, view('website._cart',['cart' =>session()->get('cart')])->render());
//            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id]) && !$request->plus_one) {

            $cart[$id]['quantity'] += $product_qty;

            session()->put('cart', $cart);
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',['cart' =>session()->get('cart')])->render());
//            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $product_qty,
            "addon_ids" => $addon_ids,
            "qty_addons" => $qty_addons,
            "id" => $product->id,
            "price" => $product->price,
            "photo" => count($product->photos)>0?$product->photos[0]->photo_path:$product->avatar
        ];

        session()->put('cart', $cart);
        return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',['cart' =>session()->get('cart')])->render());
//        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function minus(Request $request)
    {
        $id = $request->product_id;
        $product_qty = $request->product_qty;
        try {
            $product = Product::query()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }

        $cart = session()->get('cart');


        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $product_qty,
            "id" => $product->id,
            "price" => $product->price,
            "photo" => count($product->photos)>0?$product->photos[0]->photo_path:$product->avatar
        ];

        session()->put('cart', $cart);
        return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',['cart' =>session()->get('cart')])->render());
//        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,view('website._cart',['cart' =>session()->get('cart')])->render());

        }
    }
}
