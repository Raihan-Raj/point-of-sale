<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userRegistration(Request $request)
    {
        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'user registration successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'mesage' => 'user registration failed'
            ]);
        }
    }

    public function UserLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();

        if ($count == 1) {
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'user login successfull',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    }
}
