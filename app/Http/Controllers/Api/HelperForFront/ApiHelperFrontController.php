<?php

namespace App\Http\Controllers\Api\HelperForFront;

use App\Http\Controllers\Controller;
use App\Models\grade;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ApiHelperFrontController extends Controller
{
    use ApiResponseTrait;
    public function getGrades(Request $request)
    {
        $grades = Grade::with('subjects:id,name,grade_id')->get();
        return $this->successResponse($grades, "Grades with Subjects");
    }
}
