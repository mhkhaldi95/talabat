<?php

namespace App\Http\Controllers\Dashboard\UserManagement\Roles;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Admins\AdminRequest;
use App\Http\Requests\UserManagement\Roles\RoleRequest;
use App\Http\Resources\UserManagement\Roles\RoleResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:roles-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles-update', ['only' => ['update']]);
        $this->middleware('permission:roles-read', ['only' => ['index']]);
        $this->middleware('permission:roles-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        $roles = Role::query()->orderByDesc('created_at')->get();
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.roles'),'active' => false],
        ];
        return view('dashboard.user_management.roles.index', [
            'page_title' =>__('lang.roles'),
            'page_breadcrumbs' => $page_breadcrumbs,
            'roles' => $roles
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create');
        if (isset($id)) {
            $page_title = __('lang.edit');
            try {
                $item = Role::query()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('roles.index') , 'title' =>__('lang.roles'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit'):__('lang.add'),'active' => false],
        ];
        if(@$item)
        $permissions = @$item->permissions()->pluck('id')->toArray();
        return view('dashboard.user_management.roles.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
            'permission_role' => @$permissions,
            'permissions' => getCustomRoles()
        ]);
    }
    public function store(RoleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['display_name'] =  ucwords($request->name);
            unset($data['permissions']);
            DB::beginTransaction();
            $item = Role::create($data);
            DB::commit();
            $item->permissions()->attach($request->get('permissions', []));
            return $this->returnBackWithSaveDone();
        } catch (QueryException $exception) {
        return $this->invalidIntParameter();
        }
    }


    public function update($id, RoleRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();
        try {
            $item = Role::query()->find($id);
            unset($data['permissions']);
            $item->update($data);

            $item->syncPermissions($request->get('permissions', []));
            foreach ($item->users as $user){
                $user->syncPermissions($request->get('permissions', []));
            }


            DB::commit();
           return $this->returnBackWithSaveDone();
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }

    }


    public function delete(Request $request)
    {
        try {
            $item = Role::query()->find($request->id);
            $result =  $item->delete();
            if($result){
                return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

            }
            return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }
    }


}
