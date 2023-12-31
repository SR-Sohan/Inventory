<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// Page Routes 
Route::get("/login",[UserController::class,"LoginPage"]);
Route::get("/register",[UserController::class,"RegisterPage"]);
Route::get("/forgot-password",[UserController::class,"ForgotPage"]);
Route::get("/otp",[UserController::class,"OTPPage"]);
Route::get("/reset-password",[UserController::class,"ResetPage"])->middleware("tokenVerify");
Route::get("/",[HomeController::class,"homePage"]);

Route::prefix("/dashboard")->middleware("tokenVerify")->group(function(){

    // Dashboard Page
    Route::get("",[DashboardController::class,"page"]);
    Route::get("customer",[CustomerController::class,"page"]);
    Route::get("category",[CategoryController::class,"page"]);
    Route::get("profile",[UserController::class,"profilePage"]);
    Route::get("product",[ProductController::class,"page"]);
    Route::get("sales",[InvoiceController::class,"salePage"]);
    Route::get("invoice",[InvoiceController::class,"invoicePage"]);
    Route::get("report",[ReportController::class,"reportPage"]);


    // Dashboard api
    Route::get("summary",[DashboardController::class,"summary"]);

    //Customer Api
    Route::get("customer-list",[CustomerController::class,"customerList"]);
    Route::get("customer-by-id/{id}",[CustomerController::class,"customerByID"]);
    Route::post("customer-create-update",[CustomerController::class,"customerCreateUpdate"]);
    Route::post("customer-delete",[CustomerController::class,"customerDelete"]);

    // Category Api
    Route::get("category-list",[CategoryController::class,"categoryList"]);
    Route::get("category-by-id/{id}",[CategoryController::class,"categoryByID"]);
    Route::post("category-create-update",[CategoryController::class,"categoryCreateUpdate"]);
    Route::post("category-delete",[CategoryController::class,"categoryDelete"]);

    // Product Api
    Route::get("product-list",[ProductController::class,"productList"]);
    Route::get("product-by-id/{id}",[ProductController::class,"productById"]);
    Route::post("product-create-update",[ProductController::class,"productCreateUpdate"]);
    Route::post("product-delete",[ProductController::class,"productDelete"]);

    // Invoice Api
    Route::post("invoice-create",[InvoiceController::class,"invoiceCreate"]);
    Route::get("invoice-select",[InvoiceController::class,"invoiceSelect"]);
    Route::post("invoice-delete",[InvoiceController::class,"invoiceDelete"]);
    Route::post("invoice-details",[InvoiceController::class,"invoiceDetails"]);


    // Report Api
    Route::get("sales-report/{fromDate}/{toDate}",[ReportController::class,"reportCreate"]);

    

});




// User web api
Route::post("user-registration",[UserController::class,'UserRegistraion']);
Route::post("user-login",[UserController::class,'UserLogin']);
Route::post("send-otp",[UserController::class,'SendOTPCode']);
Route::post("verify-otp",[UserController::class,'VerifyOtp']);
Route::post("reset-password",[UserController::class,'ResetPassword'])->middleware("tokenVerify");
Route::get("user-profile",[UserController::class,'UserProfile'])->middleware("tokenVerify");
Route::post("update-profile",[UserController::class,'UpdateProfile'])->middleware("tokenVerify");
Route::get("logout",[UserController::class,"UserLogOut"]);
