<?php

namespace App\Http\Controllers\Branch\Orders;

use App\Classes\CreateOrder;
use App\Constants\Enum;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Notifications\OrderNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{







    public function accept(CreateOrder $createOrder)
    {
       $result =  $createOrder->accept();
       if($result){
           return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, $result);
       }
        return $this->response_json(false, StatusCodes::OK, Enum::GENERAL_ERROR, $result);
    }

    public function reject(CreateOrder $createOrder)
    {
        $result = $createOrder->reject();
        if($result){
            return $this->response_json(true, StatusCodes::OK, Enum::DONE_SUCCESSFULLY, $result);
        }
        return $this->response_json(false, StatusCodes::OK, Enum::GENERAL_ERROR, $result);
    }

}
