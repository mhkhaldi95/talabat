<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Customers\CustomerRequest;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerAccountController extends Controller
{
    public function index(Request $request){
        $page_breadcrumbs = [
            ['page' => route('break.index') , 'title' =>__('lang.home'),'active' => false],
            ['page' => '#' , 'title' =>__('breadCrumbUser'),'active' => true],
        ];
            try {
//                $branch =  Branch::query()->findOrFail($request->branch_id);
                return view('website.account',[
                    'cart' =>session()->get('cart')??null,
                    'page_breadcrumbs' =>$page_breadcrumbs,
//                    'branch' =>$branch
               ]);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
    }
    public function update(CustomerRequest $request, $id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $item = User::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }
}
