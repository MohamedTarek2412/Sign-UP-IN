<?php
declare(strict_types=1);

namespace backend\config;

final class Helpers {
    public static function respondJson(int $statusCode, array $data): void {
        // ABSOLUTELY NO CORS headers here - they're set in index.php
        http_response_code($statusCode);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function sanitizeString(string $input): string {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    public static function generateRandomString(int $length = 32): string {
        return bin2hex(random_bytes($length / 2));
    }
}
?>