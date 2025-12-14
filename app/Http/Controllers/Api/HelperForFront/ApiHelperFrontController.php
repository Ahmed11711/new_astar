<?php

namespace App\Http\Controllers\Api\HelperForFront;

use App\Models\User;
use App\Models\grade;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class ApiHelperFrontController extends Controller
{
 use ApiResponseTrait;
 public function getGrades(Request $request)
 {
  $grades = Grade::with([
   'subjects:id,name,grade_id',
   'subjects.topics:id,name,subject_id'
  ])->get();
  return $this->successResponse($grades, "Grades with Subjects");
 }

 public function allTeacherAndSchool()
 {
  $teachers = User::where('role', 'teacher')
   ->select('id', 'username', 'email', 'role')
   ->get();

  $schools = User::where('role', 'school')
   ->select('id', 'username', 'email', 'role')
   ->get();

  return $this->successResponse([
   'teachers' => $teachers,
   'schools'  => $schools,
  ], 'Teachers and Schools');
 }
}
