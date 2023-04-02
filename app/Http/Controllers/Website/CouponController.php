<?php

namespace App\Http\Controllers\Website;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Website\ProductResource;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function check($code)
    {
        try {
            $item = Coupon::query()->where('code', $code)->firstOrFail();
            $branch_id = \request('branch_id');
            $branch = Branch::query()->findOrFail($branch_id);
            if (!session()->has('coupon')) {
                if ($item->times_used < $item->max_uses) {
                    if (now() < $item->created_at->addDays($item->days)) {

                        session()->put('coupon', $item);
                        return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, view('website._cart', [
                            'cart' => session()->get('cart'),
                            'branch' => $branch,
                        ])->render());
                    }
                }
            }
            return $this->response_json(false, StatusCodes::NOT_VERTIFIED, Enum::DONE_SUCCESSFULLY, []);


        } catch (QueryException $exception) {
            return $this->invalidIntParameterJson();
        }
    }
}
