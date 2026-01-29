<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Models\Category;
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

//user profile
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
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/productPage', [ProductController::class, 'ProductPage'])->middleware(TokenVerificationMiddleware::class);
//dashboard
Route::get('/', [UserController::class, 'welcome']);
Route::get('/dashboard', [DashboardController::class, 'dashboardPage'])->middleware(TokenVerificationMiddleware::class);

//Category Api
Route::post('/category-create', [CategoryController::class, 'CategoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/category-list', [CategoryController::class, 'CategotyList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-delete', [CategoryController::class, 'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-update', [CategoryController::class, 'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-by-id', [CategoryController::class, 'CategoryById'])->middleware(TokenVerificationMiddleware::class);

//Customer Api
Route::post("/customer-create", [CustomerController::class, 'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get("/customer-list", [CustomerController::class,    'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post("/customer-delete", [CustomerController::class, 'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post("/customer-update", [CustomerController::class, 'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post("/customer-by-id", [CustomerController::class, 'CustomerById'])->middleware(TokenVerificationMiddleware::class);

//Product Api
Route::post("/product-create", [ProductController::class, 'CreateProduct'])->middleware(TokenVerificationMiddleware::class);
Route::post("/product-delete", [ProductController::class, 'ProductDelete'])->middleware(TokenVerificationMiddleware::class);
Route::get("/product-list", [ProductController::class,   'ProductList'])->middleware(TokenVerificationMiddleware::class);
Route::post("/product-update", [ProductController::class, 'ProductUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post("/product-by-id", [ProductController::class,  'ProductById'])->middleware(TokenVerificationMiddleware::class);
