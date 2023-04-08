<?php

namespace App\Http\Controllers\Dashboard\UserManagement\Branches;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Admins\AdminRequest;
use App\Http\Requests\UserManagement\Branches\BranchRequest;
use App\Http\Resources\UserManagement\Admins\AdminResource;
use App\Http\Resources\UserManagement\Branches\BranchResource;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request){
        if($request->ajax()){
            $items = Branch::with(['user'])->orderByDesc('id')->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return datatable_response($items, null, BranchResource::class);
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.branches'),'active' => false],
        ];
        return view('dashboard.user_management.branches.index', [
            'page_title' =>__('lang.branches'),
            'page_breadcrumbs' => $page_breadcrumbs,
        ]);
    }
    public function create($id = null)
    {
        $page_title = __('lang.create');
        if (isset($id)) {
            $page_title = __('lang.edit');
            try {
                $item = Branch::query()->filter()->findOrFail($id);
            } catch (QueryException $exception) {
                return $this->invalidIntParameter();
            }
        }
        $page_breadcrumbs = [
            ['page' => route('dashboard.index') , 'title' =>__('lang.home'),'active' => true],
            ['page' => route('branches.index') , 'title' =>__('lang.branches'),'active' => true],
            ['page' => '#' , 'title' =>isset($id)?__('lang.edit'):__('lang.add'),'active' => false],
        ];
        return view('dashboard.user_management.branches.create', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }
    public function store(BranchRequest $request, $id = null)
    {
        $branch_data = $request->only(Branch::FILLABLE);
        $user_data = $request->only(User::FILLABLE);
        if (isset($user_data['password'])) {
            $user_data['password'] = Hash::make($user_data['password']);
        }
        $user_data['role'] = Enum::Branch;

        DB::beginTransaction();
        try {
            $user = User::query()->updateOrCreate([
                'id' => $id,
            ], $user_data);

            $branch_data['user_id'] = $user->id;
            $branch = Branch::query()->updateOrCreate([
                'id' => $id,
            ], $branch_data);

            $role = Role::where('name','branch')->first();
            $user->roles()->sync($role->id);

            $permissions = DB::table('permission_role')->where('role_id',$role->id)->get()->pluck('permission_id')->toArray();
            $user->permissions()->sync($permissions);
            DB::commit();

            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }
    public function update($id,BranchRequest $request)
    {
        $branch_data = $request->only(Branch::FILLABLE);
        $user_data = $request->only(User::FILLABLE);
        try {
            $branch = Branch::query()->filter()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        if (isset($user_data['password'])) {
            $user_data['password'] = Hash::make($user_data['password']);
        }else {
            $user_data['password'] = $branch->user->password;
        }

        DB::beginTransaction();
        try {
            $user = User::query()->updateOrCreate([
                'id' => $branch->user->id,
            ], $user_data);

            $branch_data['user_id'] = $user->id;
            $branch = Branch::query()->updateOrCreate([
                'id' => $id,
            ], $branch_data);

            $role = Role::where('name','branch')->first();
            $user->roles()->sync($role->id);
            $permissions = DB::table('permission_role')->where('role_id',$role->id)->get()->pluck('permission_id')->toArray();
            $user->permissions()->sync($permissions);
            DB::commit();
            return $this->returnBackWithSaveDone();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnBackWithSaveDoneFailed();
        }
    }

    public function delete($id){
        try {
            $item = Branch::query()->filter()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $item->user->delete();
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
            $result = Branch::query()->whereIn('id', $ids)->delete();
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }


        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DELETED_SUCCESSFULLY);

        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR);

    }
}
