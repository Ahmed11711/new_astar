<?php

namespace App\Http\Service\HelperService;

use App\Models\User;

class UserRoleService
{
 public function getTeachersAndSchools(?int $id = null)
 {
  $query = User::whereIn('role', ['teacher', 'school'])
   ->select('id', 'username', 'email', 'role');

  if ($id) {
   return $query->where('id', $id)->first();
  }

  return $query->get()->groupBy('role');
 }
}
