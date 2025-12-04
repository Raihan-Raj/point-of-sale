<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Egulias\EmailValidator\Warning\TLD;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Api Web Route
Route::post('/user-registration', [UserController::class, 'userRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOtp']);
//Token Verify
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware(TokenVerificationMiddleware::class);
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware(TokenVerificationMiddleware::class);

//logout
Route::get('/logout', [UserController::class, 'UserLogout']);
//Pages Route
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOtpPage']);
Route::get('/resetPassword', [UserController::class, 'resetPasswordPage'])->middleware(TokenVerificationMiddleware::class);

//dashboard
Route::get('/', [UserController::class, 'welcome']);
Route::get('/dashboard', [DashboardController::class, 'dashboardPage'])->middleware(TokenVerificationMiddleware::class);
