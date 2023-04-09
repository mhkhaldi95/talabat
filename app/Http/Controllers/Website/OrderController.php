<?php

namespace App\Http\Controllers\Website;

use App\Classes\CreateOrder;
use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBranch;
use App\Notifications\OrderNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public $branch = null;

    public function __construct(Request $request)
    {
        try {

            $this->branch = Branch::query()->findOrFail($request->branch_id);
        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }

    }

    public function index(Request $request)
    {


    }

    public function store(CreateOrder $createOrder)
    {
        $is_cashback = \request('payment_method') == 'cashBack';
        $is_online = \request('payment_method') == 'online';
        $is_cash = \request('payment_method') == 'cash';
        if (checkQtyInCart($this->branch)['status']) {
            return response()->json([
                'status' => false,
                'message' => $this->checkQtyInCart()['msg']
            ]);
        }
        if ($is_cashback) {
            if (calculateOrderTotal() > floatval(auth()->user()->balance)) {
                return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR, []);
            }
        }
        $cashback = calculateCashback();
        $order = $createOrder->create(session()->get('cart'), session()->get('coupon', null));
        if ($order) {

            $user = $this->branch->user;
            Notification::send($user, new OrderNotification([
                'order_id' => $order->id,
                'branch_id' =>  $this->branch->id,
                'title_ar' => $order->id.' طلبية جديدة #',
                'title_en' => 'new order #'.$order->id,
                'body_ar' => $order->id.' طلبية جديدة #',
                'body_en' => 'new order #'.$order->id,
                'type' => 'new_order',
                'payment_method' => null,
            ]));
//            if(!$is_cash){  // هان يتم اضافة الكاش باك عند الاستلام
//                \auth()->user()->deposit($cashback);
//            }


            if ($is_cashback) {
                \auth()->user()->withdraw($order->price);
            }
            session()->forget('cart');
            session()->forget('coupon');
            return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, [
                'order' => $order,
                'cart' => view('website._cart', [
                    'cart' => session()->get('cart'),
                    'branch' => $this->branch,
                ])->render()
            ]);
        }
        return $this->response_json(false, StatusCodes::INTERNAL_ERROR, Enum::GENERAL_ERROR, []);
    }


    public function orderInfo()
    {
        return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, view('website._invoice_modal_body')->render());
    }

    public function accept(CreateOrder $createOrder)
    {
       $result =  $createOrder->accept();
       if($result){
           return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, $result);
       }
        return $this->invalidIntParameter();
    }

    public function reject(CreateOrder $createOrder)
    {
        $result = $createOrder->reject();
        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, $result);
        }
        return $this->invalidIntParameter();
    }

}
