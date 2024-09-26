<?php

namespace App\Helpers;

class ResponseHelper
{
  public static function respond($statusCode = 200, $message = '', $data = null)
  {
    if ($statusCode >= 200 && $statusCode < 400) {
      $status = 'success';
    } else {
      $status = 'failed';
    }

    if ($data != null) {
      return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
      ], $statusCode);
    } else {
      return response()->json([
        'status' => $status,
        'message' => $message
      ], $statusCode);
    }
  }
}
