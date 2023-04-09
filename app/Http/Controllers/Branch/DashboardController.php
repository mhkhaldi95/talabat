<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $page_breadcrumbs = [
            ['page' => '#' , 'title' =>__('lang.home'),'active' => false],
        ];
        $best_selling_products = (new Product())->getBestSellingProducts();
        $last_orders = Order::query()->filter()->orderBy('created_at','desc')->take(6)->get();
        $last_orders = OrderResource::collection($last_orders);
        return view('branch.dashboard',[
            'page_title' =>__('lang.home'),
            'page_breadcrumbs' => $page_breadcrumbs,
            'best_selling_products' => $best_selling_products,
            'last_orders' => $last_orders->resolve(),
        ]);
    }
}
