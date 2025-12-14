<?php

namespace App\Http\Controllers\DataEntry;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamPaperRequest;
use App\Http\Service\ExamPaperService;
use App\Traits\ApiResponseTrait;
use App\Traits\QueryableTrait;
use Illuminate\Http\Request;

class DataEntryController extends Controller
{
 use ApiResponseTrait, QueryableTrait;

 public function __construct()
 {
  throw new \Exception('Not implemented');
 }
 public function store(ExamPaperRequest $request, ExamPaperService $service)
 {
  $paper = $service->createExamPaperWithQuestions($request->validated());
  return $this->successResponse($paper);
 }

 // public function index(Request $request)
 // {
 //  $data = $this->queryIndex(
 //   $this->repository,       // Repository object
 //   \App\Http\Resources\SubjectResource::class, // Optional Resource
 //   15                       // Optional per_page default
 //  );


}
