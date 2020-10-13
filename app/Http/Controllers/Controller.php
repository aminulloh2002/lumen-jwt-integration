<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function respondWithToken($token)
    {
    return response()->json([
        'success' => true,
        'data' =>[
            'message' => 'Authorization Success!',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() .' Minutes',
        ]
    ],200);
    }
}
