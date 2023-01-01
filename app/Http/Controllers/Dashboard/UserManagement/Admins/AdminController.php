<?php

namespace App\Http\Controllers\Dashboard\UserManagement\Admins;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Admins\AdminRequest;
use App\Http\Resources\UserManagement\Admins\AdminResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admins-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admins-update', ['only' => ['create', 'update']]);
        $this->middleware('permission:admins-read', ['only' => ['index']]);
        $this->middleware('permission:admins-delete', ['only' => ['delete','deleteSelected']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $items = User::query()->orderByDesc('id')->filter('admin')->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, AdminResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.admins'),'active' => false],
        ];
        return view('dashboard.user_management.admins.index', [
            'page_title' =>__('lang.admins'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create_admin');
        if (isset($id)) {
            $page_title = __('lang.edit_admin');
            try {
                $item = User::query()->filter('admin')->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
            $roles = $item->roles()->pluck('id')->toArray();
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('admins.index') , 'title' =>__('lang.admins'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit_admin'):__('lang.add_admin'),'active' => false],
        ];
        return view('dashboard.user_management.admins.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'roles' => Role::where('name','!=','customer')->get(),
            'item' => @$item,
            'role_user' => @$roles,
        ]);
    }
    public function store(AdminRequest $request, $id = null)
    {
        $data = $request->validated();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('admins.index') , 'title' =>__('lang.admins'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.add_admin'),'active' => false],
        ];

        DB::beginTransaction();
        try {
            $item = User::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            $item = new AdminResource($item);

            $item->roles()->sync($request->get('roles', []));
            $permissions = DB::table('permission_role')->whereIn('role_id',$request->get('roles', []))->get()->pluck('permission_id')->toArray();
            $item->permissions()->sync($permissions);
            DB::commit();

            return back()->with([
                'page_title' =>__('lang.create_admin'),
                'page_breadcrumbs' => $page_breadcrumbs,
                'item' => $item,
                'message' => __('lang.save_done'),
                'alert-type' => 'success'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with([
                'page_title' =>__('lang.create_admin'),
                'page_breadcrumbs' => $page_breadcrumbs,
                'error' => __('lang.save_error'),
                'item' => @$item,
                'message' => __('lang.save_failed'),
                'alert-type' => 'error'
            ]);
        }
    }
    public function update($id,AdminRequest $request)
    {
        $data = $request->validated();
        try {
            $item = User::query()->filter('admin')->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $item->password;
        }

        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('admins.index') , 'title' =>__('lang.admins'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.edit_admin'),'active' => false],
        ];

        DB::beginTransaction();
        try {
            $item = User::query()->updateOrCreate([
                'id' => $id,
            ], $data);
            $item = new AdminResource($item);

            $item->roles()->sync($request->get('roles', []));
            $permissions = DB::table('permission_role')->whereIn('role_id',$request->get('roles', []))->get()->pluck('permission_id')->toArray();
            $item->permissions()->sync($permissions);
            DB::commit();

            return back()->with([
                'page_title' =>__('lang.create_admin'),
                'page_breadcrumbs' => $page_breadcrumbs,
                'item' => $item,
                'message' => __('lang.save_done'),
                'alert-type' => 'success'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with([
                'page_title' =>__('lang.create_admin'),
                'page_breadcrumbs' => $page_breadcrumbs,
                'error' => __('lang.save_error'),
                'item' => @$item,
                'message' => __('lang.save_failed'),
                'alert-type' => 'error'
            ]);
        }
    }

    public function delete($id){
        try {
            $item = User::query()->filter('admin')->findOrFail($id);
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
