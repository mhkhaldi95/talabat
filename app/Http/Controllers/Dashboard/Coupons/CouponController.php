<?php

namespace App\Http\Controllers\Dashboard\Coupons;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Coupons\CouponRequest;
use App\Http\Resources\Coupons\CouponResource;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:coupons-update', ['only' => ['create', 'update']]);
//        $this->middleware('permission:coupons-read', ['only' => ['index']]);
//        $this->middleware('permission:coupons-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = Coupon::query()->orderBy(getColAndDirForOrderBy(Coupon::class)['col'],getColAndDirForOrderBy(Coupon::class)['dir'])
                ->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, CouponResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.coupons'),'active' => false],
        ];
        return view('dashboard.coupons.index', [
            'page_title' =>__('lang.coupons'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create');
        if (isset($id)) {
            $page_title = __('lang.edit');
            try {
                $item = Coupon::query()->filter()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('coupons.index') , 'title' =>__('lang.coupons'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit'):__('lang.add'),'active' => false],
        ];
        return view('dashboard.coupons.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }
    public function store(CouponRequest $request, $id = null)
    {
        $data = $request->only(Coupon::FILLABLE);

        DB::beginTransaction();
        try {
            $item = Coupon::query()->updateOrCreate([
                'id' => $id,
            ], $data);

            if(!is_null($id)){
                if( session()->has('coupon') && !empty(session()->has('coupon'))){
                    if(session()->get('coupon')->id == $item->id ){
                        session()->put('coupon',$item);
                    }
                }
            }
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function delete($id){
        try {
            $item = Coupon::query()->filter()->findOrFail($id);
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
            $result = Coupon::query()->whereIn('id', $ids)->delete();
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }


        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }
}
