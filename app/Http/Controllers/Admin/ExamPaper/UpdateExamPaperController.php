<?php

namespace App\Http\Controllers\Admin\ExamPaper;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamPaperRequest;
use App\Http\Service\ExamPaperService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UpdateExamPaperController extends Controller
{
 use ApiResponseTrait;
 public function store(ExamPaperRequest $request, ExamPaperService $service)
 {
  return  $paper = $service->createExamPaperWithQuestions($request->validated());
  return $this->successResponse($paper);
 }
}
