<?php 

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class JWTToken{

    public static function CreateJwt($email):string{
        $key = env('JWT_KEY');

        $payload=[
            "iss" => "inveroty_project",
            "iat" => time(),
            "exp" => time() + 60*60,
            "email" => $email
        ];

       return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToken($token):string{
        try{
            $key = env('JWT_KEY');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded->email;
        }catch(Exception $e){
            return "unauthrized";
        }
    }
}