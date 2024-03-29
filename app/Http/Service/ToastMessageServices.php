<?php

namespace App\Http\Service;


class ToastMessageServices
{
    public static function generateValidateMessage($validate)
    {
        if ($validate) {
            if ($validate->fails()) {
                $errorMessage = $validate->errors()->first();
                return array(
                    'message' => $errorMessage,
                    'alert-type' => 'error'
                );
            }
        }
        return true;
    }
    public static function generateMessage($message,$isSuccess = true)
    {
        return array(
            'message' => $message,
            'alert-type' => $isSuccess ? 'success' : 'error'
        );
    }

    public static function generateValidateMessageJSON($validate)
    {
        if ($validate) {
            if ($validate->fails()) {
                $errorMessage = $validate->errors()->first();
                return json_encode(array(
                    'status' => $errorMessage,
                    'code' => 200
                ));
            }
        }
        return true;
    }
}
