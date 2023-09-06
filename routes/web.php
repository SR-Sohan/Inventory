<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;


// Page Routes 
Route::get("/login",[UserController::class,"LoginPage"]);
Route::get("/register",[UserController::class,"RegisterPage"]);
Route::get("/forgot-password",[UserController::class,"ForgotPage"]);
Route::get("/otp",[UserController::class,"OTPPage"]);
Route::get("/reset-password",[UserController::class,"ResetPage"]);

Route::prefix("/dashboard")->group(function(){

    // Dashboard Page
    Route::get("",[DashboardController::class,"page"]);
    Route::get("category",[CategoryController::class,"page"]);
});




// Registration web api
Route::post("user-registration",[UserController::class,'UserRegistraion']);
Route::post("user-login",[UserController::class,'UserLogin']);
Route::post("send-otp",[UserController::class,'SendOTPCode']);
Route::post("verify-otp",[UserController::class,'VerifyOtp']);
Route::post("reset-password",[UserController::class,'ResetPassword'])->middleware("tokenVerify");
Route::get("logout",[UserController::class,"UserLogOut"]);
