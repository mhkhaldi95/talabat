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
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request){
        $page_breadcrumbs = [
            ['page' => route('break.index') , 'title' =>__('lang.home'),'active' => false],
            ['page' => route('break.branches.index') , 'title' =>__('lang.branches'),'active' => false],
            ['page' => '#' , 'title' =>__('lang.products'),'active' => true],
        ];
        if (isset($request->branch_id)) {
            try {
               $branch =  Branch::query()->findOrFail($request->branch_id);
                $categories = Category::with(['products','products.photos','products.addons'])->get();
                $products= Product::query()->filter()->published()->with(['photos','addons'])->get();
                return view('website.products',[
                    'categories' => CategoryResource::collection($categories)->resolve(),
                    'products' => ProductResource::collection($products)->resolve(),
                    'cart' =>session()->get('cart')??null,
                    'branch' =>$branch,
                    'page_breadcrumbs' =>$page_breadcrumbs
               ]);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }

    }
    public function getCategoryProducts($id,Request $request)
    {

        try {
            $category =  Category::query()->findOrFail($id);
            $branch =  Branch::query()->findOrFail($request->branch_id);
            $category = (new CategoryResource($category));
            $data =  view('website._category_products', [
                'category' => $category->resolve(),
                'branch' => $branch,
            ])->render();

            return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, [
                'products' => $data,
            ]);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }



    }
}
