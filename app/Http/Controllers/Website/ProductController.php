<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request){


//        session()->put('cart', null);
//        dd(session()->get('cart'));
        if (isset($request->branch_id)) {
            try {
               $branch =  Branch::query()->findOrFail($request->branch_id);
                $categories = Category::with(['products','products.photos','products.addons'])->get();
                $products= Product::with(['photos','addons'])->get();
                return view('website.products',[
                    'categories' => CategoryResource::collection($categories)->resolve(),
                    'products' => ProductResource::collection($products)->resolve(),
                    'cart' =>session()->get('cart')??null,
                    'branch' =>$branch
               ]);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }

    }
}
