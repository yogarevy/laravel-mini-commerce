<?php

namespace App\Http\Middleware;

use App\Libraries\ResponseStd;
use App\Models\User;
use Closure;
use Symfony\Component\HttpFoundation\JsonResponse;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::where('id', auth('api')->user()->id)->first();
        $is_seller = $user['is_seller'];
        if ($is_seller) {
            return $next($request);
        }

        return ResponseStd::fail($errors = 'Unauthorized access.', JsonResponse::HTTP_FORBIDDEN, $messages = 'Error access. You must be an seller to get access.');
    }
}
