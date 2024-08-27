<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use App\Http\Middleware\DebugMiddleware;
use App\Http\Middleware\ResponseFormatterMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ResponseFormatterMiddleware::class);
        $middleware->append(DebugMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
