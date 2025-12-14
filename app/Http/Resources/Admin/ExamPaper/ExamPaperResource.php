<?php

namespace App\Http\Resources\Admin\ExamPaper;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamPaperResource extends JsonResource
{
 public function toArray($request): array
 {
  return [
   'id' => $this->id,
   'subject_id' => $this->subject_id,
   'subject_name' => $this->subject->name ?? "",
   'grade_id' => $this->grade_id,
   'grade_name' => $this->grade->name ?? "",
   'paper_id' => $this->paper_id,
   'title' => $this->title,
   'paper_label' => $this->paper_label,
   'year' => $this->year,
   'month' => $this->month,
   'is_active' => $this->is_active,
   'total_marks' => $this->total_marks,
   'duration_minutes' => $this->duration_minutes,
   'meta' => $this->meta,
   'created_at' => $this->created_at,
   'updated_at' => $this->updated_at,
  ];
 }
}
