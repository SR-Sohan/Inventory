<?php

namespace App\Http\Controllers\Auth;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function LoginPage(){
        return view("auth.loginPage");
    }

    public function RegisterPage(){
        return view("auth.registerPage");
    }

    public function ForgotPage(){
        return view("auth.forgotPage");
    }

    public function OTPPage(){
        return view("auth.otpPage");
    }
    public function ResetPage(){
        return view("auth.resetPage");
    }










    public function UserRegistraion(Request $request){

        try {
            User::create([
                "first_name" => $request->input("first_name"),
                "last_name" => $request->input("last_name"),
                "email" => $request->input("email"),
                "mobile" => $request->input("mobile"),
                "password" => $request->input("password")
            ]);

            return response()->json([
                "status" => "success",
                "message" => "User Regstrion Successfuly"
            ],200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "User Regstrion Failed"
            ]);
        }

      
    }


    public function UserLogin(Request $request){
        $user = User::where("email","=",$request->input("email"))
                    ->where("password","=",$request->input("password"))
                    ->count();
        
        if($user == 1){
            $token = JWTToken::CreateJwt($request->input("email"));

            return response()->json([
                "status" => "Success",
                "message" => "User Login Successful",
                "token" => $token
            ]);
            
        }else{
            return response()->json([
                "status" => "Failed",
                "message" => "User Unauthorized"
            ]);
        }
    }
}
