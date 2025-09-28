<?php
declare(strict_types=1);

// Clear any previous headers first
if (function_exists('header_remove')) {
    header_remove('Access-Control-Allow-Origin');
    header_remove('Access-Control-Allow-Methods');
    header_remove('Access-Control-Allow-Headers');
}

// Set CORS headers ONCE
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// Handle preflight FIRST
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["message" => "CORS preflight OK"]);
    exit();
}

// Load dependencies
require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Debug: Check if JWT_SECRET is loaded
if (empty($_ENV["JWT_SECRET"])) {
    error_log("WARNING: JWT_SECRET not loaded from .env file");
}

// Load other files
require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/config/Helpers.php";
require_once __DIR__ . "/config/Router.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/middleware/Authmiddleware.php";

// Include routes
require_once __DIR__ . "/routes/api.php";
?>