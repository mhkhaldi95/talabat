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
                $order = Order::query()->find( $request->order_id);
                return view('website.payment', [
                'order' => $order
                ]);
            }elseif($request->payment_method == 'cashBack' ){
                if(calculateOrderTotal() <= floatval(auth()->user()->balance)){
                    $order = $createOrder->create(session()->get('cart'), session()->get('coupon', null));
                    if($order){
                        session()->forget('cart');
                        session()->forget('coupon');
                        auth()->user()->withdraw($order->price);
                        return $this->returnBackWithPaymentDone();
                    }
                }

                return $this->returnBackWithPaymentFailed();
            }

        } catch (QueryException $exception) {
            return $this->returnBackWithPaymentFailed();
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
