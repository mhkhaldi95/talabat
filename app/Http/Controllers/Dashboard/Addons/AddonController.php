<?php

namespace App\Http\Controllers\Dashboard\Addons;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Addons\AddonRequest;
use App\Http\Resources\Addons\AddonResource;
use App\Models\Addon;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddonController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products-update', ['only' => ['create', 'update']]);
        $this->middleware('permission:products-read', ['only' => ['index']]);
        $this->middleware('permission:products-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = Addon::query()->orderBy(getColAndDirForOrderBy(Addon::class)['col'],getColAndDirForOrderBy(Addon::class)['dir'])
                ->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, AddonResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.addons'),'active' => false],
        ];
        return view('dashboard.addons.index', [
            'page_title' =>__('lang.addons'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create_addon');
        if (isset($id)) {
            $page_title = __('lang.edit_addon');
            try {
                $item = Addon::query()->filter()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('addons.index') , 'title' =>__('lang.addons'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit_addon'):__('lang.add_addon'),'active' => false],
        ];
        return view('dashboard.addons.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }
    public function store(AddonRequest $request, $id = null)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $item = Addon::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function delete($id){
        try {
            $item = Addon::query()->filter()->findOrFail($id);
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
            $result = Addon::query()->whereIn('id', $ids)->delete();
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }


        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }
}
