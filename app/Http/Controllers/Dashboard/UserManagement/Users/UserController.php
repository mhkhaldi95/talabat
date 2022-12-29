<?php

namespace App\Http\Controllers\Dashboard\UserManagement\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserManagement\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $items = User::query()->orderByDesc('id')->filter()->paginate(\request()->get('length', 10),'*','*',getPageNumber());
            return paginate($items, null, UserResource::class);
        }
        return view('dashboard.user_management.users.index', [
            'page_title' => __('Users'),
        ]);
    }
}
