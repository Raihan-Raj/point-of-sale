<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\CancellationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function LoginPage()
    {
        return view('frontpages.login-page');
    }
    function RegistrationPage()
    {
        return view('frontpages.registration-page');
    }
    function SendOtpPage()
    {
        return view('frontpages.sendotp-page');
    }
    function VerifyOtpPage()
    {
        return view('frontpages.verifyotp-page');
    }
    function resetPasswordPage()
    {
        return view('frontpages.resetpass-page');
    }
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

    function SendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)
            ->count();

        if ($count == 1) {
            //send otp code user email address
            Mail::to($email)->send(new OTPMail($otp));
            //otp code insert users table
            $user = User::where('email', '=', $email)
                ->update(['otp' => $otp]);
            return response()->json([
                'status' => 'success',
                'message' => '4 digit otp code send to your email please check '
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    }

    function VerifyOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)->count();

        if ($count == 1) {
            //database otp update
            $user = User::where('email', '=', $email)
                ->update(['otp' => '0']);
            //pass reset token issue
            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'Otp Verification successfull',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 200);
        }
    }

    function ResetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something Went Wrong'
            ], 401);
        }
    }
}
