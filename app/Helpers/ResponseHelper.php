<?php

namespace App\Helpers;

class ResponseHelper{
    static public function make($data=[], string $message='OK', int $status=200) {
        return response()->json([
            'status'    => $status,
            'message'   => $message,
            'data'      => $data,
        ], $status);
    }


    static public function error($errors=[], string $message='Failed', int $status=500) {
        return response()->json([
            'status'    => $status,
            'message'   => $message,
            'errors'    => $errors,
        ], $status);
    }
}