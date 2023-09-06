<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->cookie("token");

        $result = JWTToken::VerifyToken($token);

        if($result == "unauthrized"){
           return redirect("/login");
        }else{
            $request->headers->set("email",$result->email);
            $request->headers->set("userID",$result->userID);
            return $next($request);
        }

       
    }
}
