<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PageController;

return [
    'GET' => [
        '/api/health' => static function (): void {
            \App\Support\Response::json([
                'status' => 'ok',
                'service' => 'ccop-backend',
            ]);
        },
        '/api/pages' => [PageController::class, 'index'],
        '/api/dashboard' => [DashboardController::class, 'show'],
    ],
    'POST' => [
        '/api/login' => [AuthController::class, 'login'],
        '/api/register' => [AuthController::class, 'register'],
    ],
];
