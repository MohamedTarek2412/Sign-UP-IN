<?php
declare(strict_types=1);

namespace backend\controllers;
use backend\config\Database;
use backend\config\Helpers;
use backend\middleware\Authmiddleware;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use PDO;

final class UserController{
    private PDO $conn;
                               //CONSTRUCTOR\\
    public function __construct(){
        $this->conn=Database::getinstance()->getConnection();
    }
                               //REGISTER\\
    public function register():void{
        $input=json_decode(file_get_contents("php://input"),true);
        if(!$input || empty($input["name"]) || empty($input["email"])||empty($input["password"])){
            Helpers::respondJson(400, ["error" => "Invalid input"]);
            return;
        }
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$input["email"]]);
        if ($stmt->fetch()) {
            Helpers::respondJson(409, ["error" => "Email already exists"]);
            return;
        }
        $hashedPassword=password_hash($input["password"],PASSWORD_BCRYPT);
        $stmt=$this->conn->prepare("INSERT INTO users(name,email,password) values (?,?,?)");
        $stmt->execute([$input['name'],$input['email'],$hashedPassword]);
        Helpers::respondJson(201, ["message" => "User registered successfully"]);
    }
                                // LOGIN \\
    public function login(): void {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input || empty($input["email"]) || empty($input["password"])) {
            Helpers::respondJson(400, ["error" => "Invalid input"]);
            return;
        }

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$input["email"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($input["password"], $user["password"])) {
            Helpers::respondJson(401, ["error" => "Invalid email or password"]);
            return;
        }

        $secret = $_ENV["JWT_SECRET"];
        
        // Create JWT payload
        $payload = [
            "user_id" => $user["id"],
            "email" => $user["email"],
            "iat" => time(), // issued at
            "exp" => time() + (24 * 60 * 60) // expires in 24 hours
        ];

        $jwt = JWT::encode($payload, $secret, 'HS256');

        Helpers::respondJson(200, [
            "message" => "Login successful",
            "token" => $jwt,
            "user" => [
                "id" => $user["id"],
                "name" => $user["name"],
                "email" => $user["email"]
            ]
        ]);
    }
                                    // PROFILE \\
    public function profile(){
        $userData=Authmiddleware::check();
        
        Helpers::respondJson(200, [
        "message" => "Profile data",
        "user" => $userData
    ]);
    }
}