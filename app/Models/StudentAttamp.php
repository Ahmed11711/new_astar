<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttamp extends Model
{
    protected $table = 'student_attempts';

    public function examPaper()
    {
        return $this->belongsTo(ExamPaper::class, 'exam_id');
    }

    public function answers()
    {
        return $this->hasMany(answer::class, 'attempt_id');
    }
}
