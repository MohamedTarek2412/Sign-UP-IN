<?php
declare(strict_types=1);

namespace backend\routes;

use backend\config\Router;
use backend\controllers\UserController;

$routes = [
    "/register" => [
        "method" => "POST",
        "handler" => [UserController::class, "register"]
    ],
    "/login" => [
        "method" => "POST",
        "handler" => [UserController::class, "login"]
    ],
    "/profile"  => [
        "method" => "GET",
        "handler" => [UserController::class, "profile"]
    ],
];
$scriptName = dirname($_SERVER['SCRIPT_NAME']); // /todo-app/backend
$uri = str_replace($scriptName, '', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
$uri = '/' . trim($uri, '/');

// نمرر الـ method و الـ uri

Router::handle($_SERVER["REQUEST_METHOD"], $uri, $routes);
