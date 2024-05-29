<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $credential = $request->only('username', 'password');

        if (!$token = auth()->guard('api')->attempt($credential)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau Password Anda salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => auth()->user(),
            'token' => $token
        ], 200);
    }
}
