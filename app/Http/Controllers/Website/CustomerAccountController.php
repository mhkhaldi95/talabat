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

class CustomerAccountController extends Controller
{
    public function index(Request $request){
        if (isset($request->branch_id)) {
            try {
                $branch =  Branch::query()->findOrFail($request->branch_id);
                return view('website.account',[
                    'cart' =>session()->get('cart')??null,
                    'branch' =>$branch
               ]);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }

    }
}
