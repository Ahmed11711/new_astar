<?php

namespace App\Http\Requests\Admin\ExamPaper;

use App\Http\Requests\BaseRequest\BaseRequest;

class ExamPaperStoreRequest extends BaseRequest
{
 public function authorize(): bool
 {
  return true;
 }

 public function rules(): array
 {
  return [
   'subject_id' => 'required|integer|exists:subjects,id',
   'grade_id' => 'required|integer|exists:grades,id',
   'paper_id' => 'nullable|integer|exists:papers,id',
   'title' => 'required|string|max:255',
   'paper_label' => 'nullable|string|max:255',
   'year' => 'nullable',
   'month' => 'nullable|string|max:255',
   'is_active' => 'required|integer',
   'total_marks' => 'nullable|integer',
   'duration_minutes' => 'nullable|integer',
   'meta' => 'nullable|array',
  ];
 }
}
