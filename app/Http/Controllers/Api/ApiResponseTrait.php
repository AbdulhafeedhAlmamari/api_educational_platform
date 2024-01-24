<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{

    public function apiResponse($data = null, $message = null, $status = null)
    {
        $response = [
            'message'  => $message,
            'status' => $status,
            'data' => $data,
        ];
        return response($response);
    }
}
