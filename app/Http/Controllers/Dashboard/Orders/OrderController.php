<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:orders-update', ['only' => ['create', 'update']]);
//        $this->middleware('permission:orders-read', ['only' => ['index']]);
//        $this->middleware('permission:orders-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = Order::query()->orderBy(getColAndDirForOrderBy(Order::class)['col'],getColAndDirForOrderBy(Order::class)['dir'])
                ->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, OrderResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.orders'),'active' => false],
        ];
        return view('dashboard.orders.index', [
            'page_title' =>__('lang.orders'),
            'page_breadcrumbs' => $page_breadcrumbs,
            'customers' => User::query()->where('role',Enum::CUSTOMER)->get(),
            'branches' => User::query()->where('role',Enum::Branch)->get(),
        ]);
    }
    public function show($id)
    {
        $page_title = __('lang.show');
        try {
            $item = Order::query()->filter()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('admin.orders.index') , 'title' =>__('lang.orders'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.show'),'active' => false],
        ];
        return view('dashboard.orders.show', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }

    public function delete($id){
        try {
            $item = Order::query()->filter()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $item->delete();
        if($item){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }
    public function receive($id){
        try {
            $item = Order::query()->filter()->findOrFail($id);

        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $item->update([
            'status' => Enum::DONE
        ]);
        if($item){
            return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->get('ids');
        try {
            $result = Order::query()->whereIn('id', $ids)->delete();
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }


        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }
}
