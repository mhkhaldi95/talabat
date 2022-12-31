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
        $page_title = __('lang.create_role');
        if (isset($id)) {
            $page_title = __('lang.edit_role');
            try {
                $item = Role::query()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('roles.index') , 'title' =>__('lang.roles'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit_role'):__('lang.add_role'),'active' => false],
        ];
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
            return back()->with([
                'message' => __('lang.save_done'),
                'alert-type' => 'success'
            ]);
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
            DB::commit();
            return back()->with([
                'message' => __('lang.save_done'),
                'alert-type' => 'success'
            ]);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }

    }


    public function delete($id)
    {
        try {
            $item = Role::query()->find($id);
            $item->delete();
            return back()->with([
                'message' => __('lang.save_done'),
                'alert-type' => 'success'
            ]);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
    }


}
