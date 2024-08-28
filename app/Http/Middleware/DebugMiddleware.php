<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime =  microtime(true);
        $memoryAtStart = memory_get_usage();

        $response = $next($request);

        $memoryAtEnd = memory_get_usage();

        $time = round((microtime(true) - $startTime) * 1000);
        $memory = round(($memoryAtEnd - $memoryAtStart) / 1024);

        $response->headers->set('X-Debug-Time', "{$time} ms");
        $response->headers->set('X-Debug-Memory', "{$memory} KB");

        return $response;
    }
}
