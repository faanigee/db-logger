<?php

namespace Faanigee\DbLogger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Faanigee\DbLogger\Facades\DbLogger;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            DbLogger::logWithContext(
                $request->route()?->getName() ?? $request->path(),
                'http_request',
                'HTTP Request processed',
                [
                    'response_status' => $response->status(),
                    'response_time' => microtime(true) - LARAVEL_START,
                    'request_method' => $request->method(),
                    'request_path' => $request->path(),
                    'request_query' => $request->query(),
                    'request_ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]
            );
        } catch (\Exception $e) {
            // Fail silently to not disrupt the request flow
            report($e);
        }

        return $response;
    }
}