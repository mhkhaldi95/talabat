<?php

use App\Classes\Timeout;
use App\Http\Resources\Branch\ProductResource;
use App\Models\Order;
use App\Models\Permission;
use App\Models\ProductBranch;

if (!function_exists('setTimeout')) {
    function setTimeout($cb, $time, ...$args)
    {
        static $count = 0;
        $id = "timeout$count";
        $GLOBALS[$id] = new Timeout($cb, $time, $args);
        $GLOBALS[$id]->run();
        $count++;
    }

    function getCustomRoles()
    {
        $string_permissions = Permission::all()->pluck('display_name')->toArray();
        $string_models = array();
        foreach ($string_permissions as $per) {
            $result = explode(' ', $per);
            array_push($string_models, $result[1]);
        }
        return array_unique($string_models);
    }
}
function paginate($data,$request = null,$resource = null,$notification = false){
    $items =  $data->items();
    if($request && $request['pagination']){
        $page = $request['pagination']['page']??$data->currentPage();
    }else{
        $page = $data->currentPage();
    }


    if(!is_null($resource))
        $items =  $resource::collection($items);
    $meta =  [
        'page' => $page,
        'pages' => $data->lastPage(),
        'perpage' => intval($data->perPage()),
        'total' => $data->total(),
    ];
    return response()->json([
        'status' =>true,
        'data' =>$items,
        'meta' => $meta
    ]);
}
function datatable_response($data,$request = null,$resource = null,$notification = false){
    $items =  $data->items();

    if(!is_null($resource))
        $items =  $resource::collection($items);

    return response()->json([
        'recordsTotal'    => $data->total(),
        'recordsFiltered' => $data->total(),
        'data'            => $items,
    ]);
}
function getPageNumber(){
   return (request()->get('start', 0)/request()->get('length', 10))+1;
}

function getColAndDirForOrderBy($model){
    $col  = 'created_at';
    $dir  = 'desc';
    if(count($model::COL_ORDERS) > 0){
        if(@request('order')[0]['dir']){
            $dir  = @request('order')[0]['dir'];
            $col  = $model::COL_ORDERS[@request('order')[0]['column']];
        }
    }
    return ['col'=>$col,'dir'=>$dir];
}
function uploadFile($request,$folder_name,$feild='file'){
    if($request->$feild){
        $imageName = time().rand(1,100).'.'.$request->$feild->getClientOriginalExtension();
        $request->$feild->storeAs('public/'.$folder_name, $imageName);
        return $imageName;
    }
}
function convertTagsObjectToString($tags){
    $tags_str = '';
       $tags =  array_column(json_decode($tags),'value');
       foreach ($tags as $tag){
           $tags_str .= $tag.' ';
       }
     return   $tags_str;
}


function convertTagsStringToObject($tags){

    foreach (explode(' ',rtrim($tags)) as $index=>$tag){
        $data[$index]['value'] = $tag;
    }
    return $data;
}
 function lastOrderNumber($col='id',$model=Order::class){
    $col = 'id';
    $query = "CAST($col AS DECIMAL(10)) DESC";
    $r = $model::query()->orderByRaw($query)->first();
    return intval(@$r->{$col}) + 1;
}
function calculateOrderTotal(){
    $total = 0;
    $cart = session()->get('cart');
    $coupon = session()->get('coupon');
    $discount= $coupon?$coupon->discount:0;
    if(!is_null($cart) && count($cart) > 0){
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

    }
    $total = $total -  (($total * $discount)/100);
    $total = round($total);
    return $total;


}
function checkQtyInCart($branch)
{
    $cart = session()->get('cart');
    $msg = '';
    foreach ($cart as $cart_item) {
        $item = ProductBranch::query()->where('branch_id', $branch->id)->where('product_id', $cart_item['id'])->firstOrFail();
        $status = false;
        if ($item) {

            if ($item->qty < $cart_item['quantity'])
            {
                $msg .= '  الكمية المطلوبة غير متوفرة: ' . $cart_item['name'] . '<br/>';
                $status = true;
            }
        }

    }
    return ['status' => $status, 'msg' => $msg];

}




