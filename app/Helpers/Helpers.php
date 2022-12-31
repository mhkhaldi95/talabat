<?php

use App\Classes\Timeout;
use App\Models\Permission;

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
        'recordsTotal'    => $data->total(),
        'recordsFiltered' => $data->total(),
        'data'            => $items,
    ]);
}
function getPageNumber(){
   return (request()->get('start', 0)/request()->get('length', 10))+1;
}



