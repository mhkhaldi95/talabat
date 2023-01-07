<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        $categories = Category::with(['products','products.photos'])->get();
        $products= Product::with(['photos'])->get();
        return view('website.products',[
            'categories' => CategoryResource::collection($categories)->resolve(),
            'products' => ProductResource::collection($products)->resolve(),
            'cart' =>session()->get('cart')??null
        ]);
    }
}
