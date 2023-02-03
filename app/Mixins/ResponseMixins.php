<?php


namespace App\Mixins;


use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class ResponseMixins
{
    public function successResponse()
    {
        return function ($data, $message = null, $code = Response::HTTP_OK) {
            $message = (!$message) ? Lang::get('messages.success') : $message;
            return response()->json([
                'code'    => $code,
                'status'  => 1,
                'errors'  => null,
                'message' => $message,
                'data'    => $data
            ], $code);
        };
    }

    public function errorResponse()
    {
        return function ($message = null, $data = [], $code = Response::HTTP_BAD_REQUEST, $status = 0) {
            if ($code == 0) $code = 400;
            $message = (!$message) ? Lang::get('messages.fail_msg') : $message;
            return response()->json([
                'code'    => $code,
                'status'  => $status,
                'errors'  => $data,
                'message' => $message,
                'data'    => null
            ], $code);
        };
    }
}
