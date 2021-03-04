<?php

namespace App\Traits;

trait ApiResponse
{
    function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'statusCode' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
