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
        $grades = Grade::with('subjects:id,name,grade_id')->get();
        return $this->successResponse($grades, "Grades with Subjects");
    }

    public function allTeacherAndSchool()
    {
        $users = User::teachersAndStudents()
            ->select('id', 'username', 'email', 'role')
            ->get();
        return $this->successResponse($users, 'Teachers and Students');
    }
}
