<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
