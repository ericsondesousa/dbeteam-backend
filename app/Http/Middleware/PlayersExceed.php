<?php

namespace App\Http\Middleware;

use Closure;
use ErrorException;
use App\Helper\PlayerHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayersExceed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (true || PlayerHelper::qtyPlayersIsExceeded()) {
            throw new ErrorException(__('player.limit_exceed'), 403);
        }

        return $next($request);
    }
}
