<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class RoleToken
{
    public function handle(Request $request, Closure $next)
    {
        // Log::info('RoleToken middleware started', [
        //     'path'   => $request->path(),
        //     'method'=> $request->method(),
        // ]);

        try {
            $user = JWTAuth::parseToken()->authenticate();

            // Log::info('Authenticated user', [
            //     'user_id' => $user?->id,
            //     'role'    => $user?->role,
            // ]);

            if (!$user) {
                Log::warning('User not found');
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // roles جاية من route group
            $roles = (array) $request->route()?->getAction('roles');

            // Log::info('Allowed roles for this route', [
            //     'roles' => $roles,
            // ]);

            if (!empty($roles) && !in_array($user->role, $roles)) {
                Log::warning('Unauthorized role access attempt', [
                    'user_role'   => $user->role,
                    'allowed'     => $roles,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

        } catch (TokenExpiredException $e) {
            Log::error('JWT token expired', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Token expired'
            ], 401);

        } catch (TokenInvalidException $e) {
            Log::error('JWT token invalid', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Token invalid'
            ], 401);

        } catch (JWTException $e) {
            Log::error('JWT token missing', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Token not provided'
            ], 401);

        } catch (\Throwable $e) {
            Log::critical('Unexpected error in RoleToken middleware', [
                'exception' => $e,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Log::info('RoleToken middleware passed successfully');

        return $next($request);
    }
}
