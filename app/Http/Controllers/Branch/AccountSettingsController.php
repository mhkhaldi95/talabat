<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:admins-update', ['only' => ['create', 'update']]);
    }
    public function create($id){
        $page_title = __('lang.Account Settings');
        try {
            $item = User::query()->findOrFail($id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameter();
        }
        $page_breadcrumbs = [
            ['page' => route('branch.dashboard') , 'title' =>__('lang.home'),'active' => true],
            ['page' => '#' , 'title' =>__('lang.Account Settings'),'active' => false],
        ];
        return view('branch.user_management.account', [
            'page_title' =>$page_title,
            'page_breadcrumbs' => $page_breadcrumbs,
            'item' => @$item,
        ]);
    }
    public function updateInfo(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data['name'] = $request->name;
        if($request->photo){
            $data['photo'] =  uploadFile($request,'user-photos','photo');
        }
        $item = User::query()->updateOrCreate([
            'id' => Auth::id()
        ],$data);
        $item->branch->update([
            'status' => $request->status
        ]);
        return $this->returnBackWithSaveDone();

    }
    public function updateEmail(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'confirmemailpassword' => 'required|string|max:255',
        ]);
        $data['email'] = $request->email;
        if (Hash::check($request->confirmemailpassword, auth()->user()->password)) {
            User::query()->updateOrCreate([
                'id' => Auth::id()
            ],$data);
            return $this->returnBackWithSaveDone();
        }
        return $this->returnBackWithSaveDoneFailed();

    }
    public function updatePassword(Request $request){
        $request->validate([
            'currentpassword' => 'required|string|max:255',
            'password' => 'required|min:3|confirmed',
        ]);
        $data['password'] = Hash::make($request->password);
        if (Hash::check($request->currentpassword, auth()->user()->password)) {
            User::query()->updateOrCreate([
                'id' => Auth::id()
            ],$data);
            return $this->returnBackWithSaveDone();
        }
        return $this->returnBackWithSaveDoneFailed();
    }
}
