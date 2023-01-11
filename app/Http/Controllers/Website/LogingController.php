<?php

namespace App\Http\Controllers\Website;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Code;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogingController extends Controller
{

    public function checkPhoneNumber(Request $request){
        $request->validate([
            'phone' => ['required','numeric']
        ]);

        try {
            $is_new = 0;
            $item = User::query()->customerFilter()->where('phone',$request->phone)->first();
            if(!$item){
                $is_new = 1;
               $item =  User::create([
                   'phone' =>$request->phone,
                   'role' => Enum::CUSTOMER,
                   'password' => '$2y$10$Pmhe9HZwqYDZxDZHBJXyf.CxSt40m88poWbtNPuv2Bdf8qq1Q/9UC' // 123456
               ]);
            }
            $code = Code::create([
                'code' => 11111,
                'user_id' => $item->id,
                'expire_at' => Carbon::now()->addSeconds(30),
            ]);
            return  $this->response_json(true,StatusCodes::OK,Enum::DONE_SUCCESSFULLY,[
                'is_new' =>$is_new,
                'phone' =>$request->phone,
                'check_code_modal' =>view('website._check_code_modal',[
                    'phone' =>$request->phone,
                ])->render()
            ]);

        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }
    }
    public function checkCodeSms(Request $request)
    {
        $request->validate([
            'code' => ['required','max:5'],
            'phone' => ['required','numeric']
        ]);
        $user = User::customerFilter()->where('phone', $request->phone)->first();
        $code = $user ? $user->activeCode() : null;
        if (is_null($code)) {

            return response()->json([
                'status' => false,
                'message' => __('Code  Expire'),
            ]);
        }
        if ($user && $code && $code->code == $request->code) {
                Auth::login($user);
            return $this->response_json(true, StatusCodes::OK, Enum::_SUCCESSFULLY,[
                'is_logged_in' => Auth::check()
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please, Enter The Right Code',
            ]);
        }
    }

    public function codeAgain(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
        ]);
        $user = User::clients()->where('phone', $request->phoneNumber)->first();
        if ($user) {
            if (!$user->activeCode()) {
                $code = $user->codes->orderBy('created_at', 'desc')->first();
                if ($code) {
                    $code->update(['expire_at' => Carbon::now()->addSeconds(30)]);
                }
                return response()->json([
                    'status' => true,
                    'message' => __('Send code again successfully'),
                ]);
            }

        }
        return response()->json([
            'status' => false,
            'message' => __('Invalid data'),
        ]);


    }

    public function generateRandomString($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function logout(){
        Session::flush();
        auth('web')->logout();
        return redirect()->route('break.index')->with([
            'success' => __('lang.Signed out Successfully')
        ]);
    }
}
