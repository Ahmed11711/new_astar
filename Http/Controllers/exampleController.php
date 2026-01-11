<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamPaperRequest;
use App\Http\Service\ExamPaperService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class exampleController extends Controller
{
 use ApiResponseTrait;

 public function store(ExamPaperRequest $request, ExamPaperService $service)
 {
  $paper = $service->createExamPaperWithQuestions($request->validated());
  return $this->successResponse($paper);
 }
}
