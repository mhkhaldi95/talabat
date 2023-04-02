<?php

namespace App\Classes;

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
            $item = Order::create([
                'coupon_id' => $coupon ? $coupon->id : null,
                'price' => $total,
                'branch_id' => request()->get('branch_id'),
                'user_id' => Auth::id(),
            ]);
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
