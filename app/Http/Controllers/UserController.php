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
    function welcome()
    {
        return view('UserProfile.welcome-page');
    }
    function LoginPage()
    {
        return view('UserProfile.login-page');
    }
    function RegistrationPage()
    {
        return view('UserProfile.registration-page');
    }
    function SendOtpPage()
    {
        return view('UserProfile.sendotp-page');
    }
    function VerifyOtpPage()
    {
        return view('UserProfile.verifyotp-page');
    }
    function resetPasswordPage()
    {
        return view('UserProfile.resetpass-page');
    }

    function ProfilePage()
    {
        return view('Backpage.UserProfile');
    }

    function UserProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successfull',
            'data' => $user
        ], 200);
    }

    function UpdateProfile(Request $request)
    {
        try {
            $email = $request->header('email');
            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            User::where('email', '=', $email)->update([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'mobile' => $mobile,
                'password' => $password
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successfull'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something Went Wrong'


            ]);
        }
    }

    function UserLogout()
    {
        return redirect('/userLogin')->cookie('token', '', -1);
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
            ->select('id')->first();

        if ($count !== null) {
            $token = JWTToken::CreateToken($request->input('email'), $count->id);
            return response()->json([
                'status' => 'success',
                'message' => 'user login successfull',
                /* 'token' => $token */
            ], 200)->cookie('token', $token, 60 * 24 * 30); //token saved cookies
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
            ], 200)->cookie('token', $token, 60 * 24 * 30);
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
