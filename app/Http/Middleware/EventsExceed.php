<?php

namespace App\Http\Middleware;

use Closure;
use ErrorException;
use App\Helper\EventHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsExceed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (EventHelper::qtyEventsIsExceeded()) {
            throw new ErrorException(__('event.limit_exceed'), 403);
        }

        return $next($request);
    }
}
