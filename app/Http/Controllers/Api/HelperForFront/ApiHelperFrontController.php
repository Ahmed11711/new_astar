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

        $grades = grade::with('subject')->get();
        return $this->successResponse($grades, "Grades with Subject");
    }
}
