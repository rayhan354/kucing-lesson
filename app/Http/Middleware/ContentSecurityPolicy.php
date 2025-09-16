<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Set the CSP header with your directives
        $csp = "default-src 'self'; " .  // Fallback for unspecified sources
               "script-src 'self' js-cdn.dynatrace.com; " .  // Allow scripts from self and Dynatrace CDN
               "style-src 'self' 'unsafe-inline'; " .  // Example: Allow inline styles if needed (common in Filament/Livewire)
               "img-src 'self' data:; " .  // Example: Allow images from self and data URIs
               "connect-src 'self' *.dynatrace.com *.live.dynatrace.com *.apps.dynatrace.com;";  // Allow connections to Dynatrace for monitoring data (recommended)

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}