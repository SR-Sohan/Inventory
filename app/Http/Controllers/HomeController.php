<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(Request $request){
        
        $token = $request->cookie("token");

        if($token){
            return redirect("/dashboard");
        }else{
            return view("home.home");
        }
        
    }
}
