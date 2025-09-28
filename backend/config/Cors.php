<?php
// File: backend/config/Cors.php
declare(strict_types=1);

namespace backend\config;

final class Cors {
    public static function handle(): void {
        // Allow specific origins (change this to your frontend URL)
        $allowedOrigins = [
            'http://localhost:3000',    // React dev server
            'http://localhost:5173',    // Vite dev server
            'http://127.0.0.1:5173',   // Alternative localhost
            'http://127.0.0.1:3000'    // Alternative localhost
        ];

        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        
        if (in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        }
        
        // Allow specific headers
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        
        // Allow specific methods
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        
        // Allow credentials
        header("Access-Control-Allow-Credentials: true");
        
        // Handle preflight requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }
}
