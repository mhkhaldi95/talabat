<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Constants\Enum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('dashboard/auth/signin');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(in_array(auth()->user()->role,[Enum::SUPER_ADMIN,Enum::ADMIN]) ){
                return redirect()->route('dashboard.index')->with([
                    'success' => 'Signed in'
                ]);
            }elseif(auth()->user()->role == Enum::Branch){
                return redirect()->route('branch.dashboard')->with([
                    'success' => 'Signed in'
                ]);
            }

        }
        return redirect()->route('login')->with([
            'error' => __('lang.login_not_valid')
        ]);
    }
    public function logout(){
        Session::flush();
        auth('web')->logout();

        return redirect()->route('login')->with([
            'success' => __('lang.Signed out Successfully')
        ]);
    }
}
