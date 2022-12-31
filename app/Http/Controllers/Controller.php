<?php

namespace App\Http\Controllers;

use App\Constants\Enum;
use App\Constants\StatusCodes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function invalidIntParameter()
    {
        return back()->with([
            'message' => __('lang.something went error'),
            'alert-type' => 'error'
        ]);
    }
    public function invalidIntParameterJson(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'code' => StatusCodes::INTERNAL_ERROR,
            'message' => @__(Enum::GENERAL_ERROR)['value'],
            'data' => [],
        ],StatusCodes::INTERNAL_ERROR);
    }
    public function response_json($status, $code, $message_code, $data = [], $extra_data = [])
    {
        $response = array_merge([
            'status' => $status,
            'code' => $code,
            'message' => @__($message_code)['value'],
            'data' => $data,
        ], $extra_data);
        return response()->json($response, $code);
    }

}
