<?php

namespace App\Http\Middleware;

use App\Enums\Status;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as StatusCodes;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
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
        try {
            if (! JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => __('You are not signed in')], StatusCodes::HTTP_UNAUTHORIZED);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => __('Token expired')], StatusCodes::HTTP_UNAUTHORIZED); // Expired login status
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => __('Invalid Token')], StatusCodes::HTTP_UNAUTHORIZED); // Invalid login status
        } catch (JWTException $e) {
            return response()->json(['message' => __('Authorization token not found')], StatusCodes::HTTP_UNAUTHORIZED); // Unauthorized status
        }

        return $next($request);
    }
}
