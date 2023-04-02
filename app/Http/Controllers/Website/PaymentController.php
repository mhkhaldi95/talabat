<?php

namespace App\Http\Controllers\Website;

use App\Classes\CreateOrder;
use App\Classes\CreatePayment;
use App\Http\Controllers\Controller;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index(Request $request, CreateOrder $createOrder)
    {

        try {
            if($request->payment_method == 'online'){
                //            $order = $createOrder->create(session()->get('cart'), session()->get('coupon', null));
                return view('website.payment', [
//                'order' => $order
                ]);
            }else{
                $order = $createOrder->create(session()->get('cart'), session()->get('coupon', null));

                if($request->payment_method == 'cashBack' && $order->price > auth()->user()->balance){
                    return $this->returnBackWithPaymentFailed();
                }
                if($order){
                    return $this->returnBackWithPaymentDone();
                }
                return $this->returnBackWithPaymentFailed();
            }

        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }
    }

    public function callBack(CreateOrder $createOrder, CreatePayment $createPayment)
    {
        $result = $createPayment->callBack($createOrder);
        if($result){
            return $this->returnBackWithPaymentDone();
        }
        return $this->returnBackWithPaymentFailed();
    }

    public function completed(Request $request, CreateOrder $createOrder)
    {
//        $order =  $createOrder->create(session()->get('cart'),session()->get('coupon',null));
        return response()->json([
            'status' => true
        ]);

    }
    public function checkCashback()
    {
        return response()->json([
            'status' => calculateOrderTotal() <= auth()->user()->balance
        ]);

    }

}
