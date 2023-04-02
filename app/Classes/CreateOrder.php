<?php

namespace App\Classes;

use App\Constants\Enum;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\throwException;

class CreateOrder
{
    public function create($cart, $coupon = null)
    {
        DB::beginTransaction();
            $total = 0;
            $items = [];
            foreach ($cart as $item) {
                unset($item['photo']);
                unset($item['name']);
                $item['product_id'] = $item['id'];
                unset($item['id']);
                $items[] = $item;
                $total += ($item['price'] * $item['quantity']);

            }
            $data = [
                'coupon_id' => $coupon ? $coupon->id : null,
                'price' => $total,
                'branch_id' => request()->get('branch_id'),
                'user_id' => Auth::id(),
            ];

            if( request('payment_method') != 'online' && !empty(request('payment_method'))){
                if(request('payment_method') == 'cashBack'){
                    $payment_method = 'wallet';
                }else{
                    $payment_method = 'cash';
                }
                $data+=  [
                    'status' =>Enum::PAID,
                    'payment_method' =>  $payment_method
                ];
            }

            $item = Order::create($data);
            foreach ($items as $row) {
                $row['order_id'] = $item->id;
                $row['addon_ids'] = json_encode($row['addon_ids']);
                $row['qty_addons'] = json_encode($row['qty_addons']);
                OrderItem::query()->create($row);
            }


            DB::commit();
            return $item;
    }
}
