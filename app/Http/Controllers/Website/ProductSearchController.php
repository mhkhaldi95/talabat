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

class ProductSearchController extends Controller
{
    public $branch = null;

    public function __construct()
    {
        if (isset(request()->branch_id)) {
            try {
                $this->branch = Branch::query()->findOrFail(request()->branch_id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
    }

    public function index(Request $request)
    {

        $products = Product::query()->filter()->published()->with(['photos', 'addons'])->get();
        return view('website.products_search', [
            'products' => ProductResource::collection($products)->resolve(),
            'cart' => session()->get('cart') ?? null,
            'branch' => $this->branch
        ]);


    }


    public function filter(Request $request)
    {

        $products = Product::query()->filter()->published()->with(['photos', 'addons'])->get();
        $data = view('website._product_search', ['products' => ProductResource::collection($products)->resolve(), 'branch' => $this->branch])->render();
        return $this->response_json(true, StatusCodes::OK, Enum::_SUCCESSFULLY, [
            'products' => $data,
            'branch' => $this->branch
        ]);
    }
}
