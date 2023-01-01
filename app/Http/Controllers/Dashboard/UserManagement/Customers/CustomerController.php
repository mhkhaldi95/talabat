<?php

namespace App\Http\Controllers\Dashboard\UserManagement\Customers;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Customers\CustomerRequest;
use App\Http\Resources\UserManagement\Customers\CustomerResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:customers-update', ['only' => ['create', 'update']]);
        $this->middleware('permission:customers-read', ['only' => ['index']]);
        $this->middleware('permission:customers-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = User::query()->orderByDesc('id')->customerFilter('customer')->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, CustomerResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.customers'),'active' => false],
        ];
        return view('dashboard.user_management.customers.index', [
            'page_title' =>__('lang.customers'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create_customer');
        if (isset($id)) {
            $page_title = __('lang.edit_customer');
            try {
                $item = User::query()->customerFilter('customer')->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('customers.index') , 'title' =>__('lang.customers'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit_customer'):__('lang.add_customer'),'active' => false],
        ];
        return view('dashboard.user_management.customers.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }
    public function store(CustomerRequest $request, $id = null)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $item = User::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            if(is_null($id))
            $item->attachRole('customer');
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function delete($id){
        try {
            $item = User::query()->customerFilter('customer')->findOrFail($id);
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
