<?php

namespace App\Classes;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductBranch;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\throwException;

class CreatePayment
{
    public function callBack(CreateOrder $createOrder)
    {
        DB::beginTransaction();
        $order = $createOrder->create(session()->get('cart'), session()->get('coupon', null));

        $id = request('id');
        $token = base64_encode('sk_test_R4jMBkA5k11fuJmiRpsyuJk1Tt9f96ySwrqQRHmK');
        $paymentService = new \Moyasar\Providers\PaymentService();
        $payment = $paymentService->fetch($id);

        if ($payment->status == 'paid') {
//                Http::baseUrl('https://api.moyasar.com/v1/')
//                    ->withHeaders([
//                        'Authorization' => "Basic {$token}"
//                    ])->post('payments/{$id}/capture')->json();
//            $payment->capture();
//            $order = Order::query()->find($payment->metadata['order_id']);
            ;
            if ($order) {
                $order->update([
                    'payment_id' => $id,
                    'status' => 'paid'
                ]);
                if ($order->coupon_id) {
                    $coupon = Coupon::query()->find($order->coupon_id);
                    if ($coupon) {
                        $coupon->times_used = $coupon->times_used + 1;
                        $coupon->save();
                    }
                }
                $cashback = 0;
                foreach ($order->items as $item) {
                    $cashback += $item->cashback;
                   $product_branch =  ProductBranch::query()
                        ->where('branch_id', $order->branch_id)
                        ->where('product_id', $item->product_id)
                        ->first();
                   if($product_branch){
                       $product_branch->qty = $product_branch->qty - $item->quantity;
                       $product_branch->save();
                   }
                }

                auth()->user()->deposit($cashback);
                session()->forget('cart');
                session()->forget('coupon');
                DB::commit();
                return true;
            }

        }


        DB::commit();
        return false;
    }
}
