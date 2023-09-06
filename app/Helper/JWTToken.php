<?php 

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JWTToken{

    public static function CreateJwt($email,$userID):string{
        $key = env('JWT_KEY');

        $payload=[
            "iss" => "inveroty_project",
            "iat" => time(),
            "exp" => time() + 60*60,
            "email" => $email,
            "userID" => $userID
        ];

       return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToken($token):string|object{
        try{
            if($token == null){
                return "unauthrized";
            }else{
                $key = env('JWT_KEY');
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return $decoded;
            }
         
        }catch(Exception $e){
            return "unauthrized";
        }
    }
}