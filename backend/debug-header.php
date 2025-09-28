<?php
// File: backend/debug-headers.php
// Create this file to debug headers

// Don't set any headers, just show what's already set
echo "<h1>Debug Headers</h1>";
echo "<h2>All Response Headers:</h2>";
echo "<pre>";
foreach (headers_list() as $header) {
    echo $header . "\n";
}
echo "</pre>";

echo "<h2>Apache Headers (if any):</h2>";
echo "<pre>";
if (function_exists('apache_response_headers')) {
    foreach (apache_response_headers() as $header => $value) {
        echo "$header: $value\n";
    }
} else {
    echo "apache_response_headers() not available\n";
}
echo "</pre>";

echo "<h2>Server Info:</h2>";
echo "<pre>";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "</pre>";

// Now set our clean CORS headers
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

echo "<h2>Headers after setting ours:</h2>";
echo "<pre>";
foreach (headers_list() as $header) {
    echo $header . "\n";
}
echo "</pre>";
?>