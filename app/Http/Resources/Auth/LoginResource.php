<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
 public function toArray(Request $request): array
 {
  return [
   'user' => [
    'id'         => $this->id,
    'email'      => $this->email,
    'first_name' => $this->first_name,
    'last_name'  => $this->last_name,
   ],
   'profile' => [
    'id'                => $this->id,
    'role'              => $this->role ?? null,
    'student_type'      => $this->student_type ?? null,
    'educational_stage' => $this->educational_stage ?? null,
    'school'            => $this->school ?? null,
   ],
   'tokens' => [
    'access'  => $this->access_token ?? null,
    'refresh' => $this->access_token ?? null,
   ],
  ];
 }
}
