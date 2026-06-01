<?php

declare(strict_types=1);

require __DIR__ . '/../bootstrap/autoload.php';

$routes = require __DIR__ . '/../routes/api.php';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if (!isset($routes[$method][$path])) {
    \App\Support\Response::json([
        'message' => 'Маршрут не найден.',
        'path' => $path,
        'method' => $method,
    ], 404);
    return;
}

$handler = $routes[$method][$path];
$rawBody = file_get_contents('php://input') ?: '';
$payload = $rawBody !== '' ? json_decode($rawBody, true) : [];
$payload = is_array($payload) ? $payload : [];

if (is_callable($handler)) {
    $handler();
    return;
}

[$className, $action] = $handler;
$controller = new $className();

if ($method === 'GET') {
    $controller->$action($_GET);
    return;
}

$controller->$action($payload);
