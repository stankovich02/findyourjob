<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AccessLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessLogPath = 'logs/AccessLog.txt'; // Putanja do fajla
        $accessLog = Storage::get($accessLogPath); // Uzimanje sadržaja iz fajla

        // Dodavanje novog reda u log
        $accessLog .= date('Y-m-d H:i:s') . ' ' . $request->ip() . ' ' . $request->path() . ' ' . $request->method() . PHP_EOL;

        // Upisivanje novog sadržaja u fajl
        Storage::put($accessLogPath, $accessLog);

        return $next($request);
    }
}
