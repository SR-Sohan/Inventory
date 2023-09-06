<?php

namespace App\Http\Controllers\Auth;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function profilePage(){
        return view("admin.pages.profile");
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
                    ->select("id")->first();
        
        if($user !== null){

            $token = JWTToken::CreateJwt($request->input("email"),$user->id);

            return response()->json([
                "status" => "Success",
                "message" => "User Login Successful",
            ])->cookie("token", $token,60*24*30);
            
        }else{
            return response()->json([
                "status" => "Failed",
                "message" => "User Unauthorized"
            ]);
        }
    }


    public function SendOTPCode(Request $request){
        $email = $request->input("email");
        $otp = rand(1000,9999);
        $user = User::where("email","=",$email)->count();

        if($user == 1){

            Mail::to($email)->send(new OTPMail($otp));
            User::where("email","=",$email)->update(["otp" => $otp]);
            return response()->json([
                "status" => "success",
                "message" => "4 Digit otp code send your email"
            ]);

        }else{
            return response()->json([
                "status" => "Failed",
                "message" => "User Unauthorized"
            ]);
        }
    }


    public function VerifyOtp(Request $request){
        $email = $request->input("email");
        $otp = $request->input("otp");

        $user = User::where("email" , "=", $email)->where("otp" , "=",$otp)->select("id")->first();

        if($user !== null){
            // Update Otp
            User::where("email","=",$email)->update(["otp" => '0']);

            $token = JWTToken::CreateJwt($email,$user->id);

            return response()->json([
                "status" => "success",
                "message" => "OTP Verify Successful",
              
            ])->cookie("token",$token);


        }else{
            return response()->json([
                "status" => "Failed",
                "message" => "User Unauthorized"
            ]);
        }
    }

    public function ResetPassword(Request $request){

        try {
            $email = $request->header("email");
            $password = $request->input("password");

            User::where("email","=",$email)->update(["password"=> $password]);
            return response()->json([
                "status" => "success",
                "message" => "Password Change Successful",
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "Failed",
                "message" => "User Unauthorized"
            ]);
        }

       
    }

    public function UserLogOut(){
        return redirect("/login")->cookie("token",'',-1);
    }

    public function UserProfile(Request $request){
        $userID = $request->header("userID");

        $user = User::find($userID);

        if($user !== null){
            return response()->json([
                "status" => "success",
                "message" => "User Get",
                "data" => $user
            ]);
        }else{
            return response()->json([
                "status" => "Failed",
                "message" => "User Unauthorized"
            ]);
        }
    }

    public function UpdateProfile(Request $request){

        try {
            $userID = $request->header("userID");
            $first_name = $request->input("first_name");
            $last_name = $request->input("last_name");
            $mobile = $request->input("mobile");
            $password = $request->input("password");    
             User::where("id","=",$userID)->update(["first_name" => $first_name,"last_name" => $last_name,"mobile" => $mobile,"password"=> $password]);

             return response()->json([
                "status" => "success",
                "message" => "Profile Update Successful",
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => "Failed",
                "message" => "User Can't Update"
            ]);
        }
       
    }
}
