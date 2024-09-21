<?php

namespace App\Traits;

trait ApiResponseTrait
{

    public function successResponse($data, $flag = 'data', $message = 'done succesfuly', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' =>  $message,
            $flag => $data
        ], $code);
    }

    public function failedResponse($message = 'Something went wrong', $code = 422)
    {
        return response()->json([
            'status' => false,
            'message' =>  $message,
        ], $code);
    }
}
