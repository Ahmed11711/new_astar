<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamPaper extends Model
{
 protected $guarded = [];

 protected $casts = [
  'is_active' => 'boolean',
  'meta'      => 'array',
 ];

 public function questions()
 {
  return $this->hasMany(Question::class, 'exam_paper_id');
 }
}
