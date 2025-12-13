<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
 use ApiResponseTrait;

 public function login(LoginRequest $request)
 {
  try {
   Log::info('Login attempt for email: ' . $request->email);

   // تحقق من وجود المستخدم
   $user = User::where('email', $request->email)->first();

   if (!$user || !Hash::check($request->password, $user->password)) {
    Log::warning('Invalid credentials for email: ' . $request->email);
    return $this->errorResponse('Invalid credentials', 401);
   }

   // إنشاء التوكن مباشرة من المستخدم
   $access_token  = JWTAuth::fromUser($user);
   $refresh_token = JWTAuth::refresh($access_token);

   // إرفاق التوكنات بالمستخدم
   $user->access_token  = $access_token;
   $user->refresh_token = $refresh_token;

   Log::info('Login successful for email: ' . $request->email);
   return $this->successResponse(new LoginResource($user));
  } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
   Log::error('JWT error: ' . $e->getMessage());
   return $this->errorResponse('Could not create token', 500);
  } catch (\Exception $e) {
   Log::error('General error: ' . $e->getMessage());
   return $this->errorResponse('An unexpected error occurred', 500);
  }
 }
}
