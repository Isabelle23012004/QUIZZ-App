<?php
require_once '../vendor/autoload.php';

use App\Controllers\HomeController;

// Initialize the application
$controller = new HomeController();

// Simple routing
$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/' || $requestUri === '/home') {
    $controller->index();
} else {
    http_response_code(404);
    echo "404 Not Found";
}
?>