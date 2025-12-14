<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;




class LoginController extends Controller
{

 use ApiResponseTrait;

 public function login(Request $request)
 {
  $credentials = $request->only('email', 'password');

  try {
   if (! $token = JWTAuth::attempt($credentials)) {
    return response()->json(['error' => 'Invalid credentials'], 401);
   }

   // Get the authenticated user.
   $user = auth()->user();

   // (optional) Attach the role to the token.
   $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

   return response()->json(compact('token'));
  } catch (JWTException $e) {
   return response()->json(['error' => 'Could not create token'], 500);
  }
 }
}
