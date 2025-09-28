<?php
declare(strict_types=1);

namespace backend\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\key;
use backend\config\Helpers;

final class Authmiddleware
{
    public static function check():array{
        $headers=getallheaders();
        if(!isset($headers["Authorization"])){
            Helpers::respondJson(401,["error"=>"No Tokens Provided"]);
        }
          $authHeader = $headers["Authorization"];
    $token = str_replace("Bearer ", "", $authHeader);

    try {
        
        $secret = $_ENV["JWT_SECRET"] ?? "default_secret";

        $decoded = JWT::decode($token, new Key($secret, 'HS256'));
        return (array) $decoded; 
    } catch (\Exception $e) {
        Helpers::respondJson(401, ["error" => "Invalid or expired token"]);
    }
} 

}
