<?php
declare(strict_types=1);

namespace backend\config;

final class Router {
    public static function handle(string $method, string $uri, array $routes): void {
        foreach ($routes as $route => $action) {
            if ($route === $uri && $method === $action['method']) {
                [$controller, $function] = $action['handler'];
                (new $controller())->$function();
                return;
            }
        }
        Helpers::respondJson(404, ["error" => "Route not found"]);
    }
}
