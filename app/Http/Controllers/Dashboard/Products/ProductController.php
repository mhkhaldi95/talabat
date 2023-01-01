<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products-update', ['only' => ['create', 'update']]);
        $this->middleware('permission:products-read', ['only' => ['index']]);
        $this->middleware('permission:products-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = User::query()->orderByDesc('id')->productFilter('product')->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, ProductResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.products'),'active' => false],
        ];
        return view('dashboard.products.index', [
            'page_title' =>__('lang.products'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create_product');
        if (isset($id)) {
            $page_title = __('lang.edit_product');
            try {
                $item = User::query()->productFilter('product')->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('products.index') , 'title' =>__('lang.products'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit_product'):__('lang.add_product'),'active' => false],
        ];
        return view('dashboard.products.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }
    public function store(ProductRequest $request, $id = null)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $item = User::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            if(is_null($id))
            $item->attachRole('product');
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function delete($id){
        try {
            $item = User::query()->productFilter('product')->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $item->delete();
        if($item){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->get('ids');
        try {
            $result = User::query()->whereIn('id', $ids)->forceDelete();
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }


        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }
}
