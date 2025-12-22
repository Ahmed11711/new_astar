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

    public function سس()
    {
        return $this->hasMany(answer::class, 'attempt_id');
    }
    public function answers()
    {
        return $this->hasOne(Answer::class, 'question_id')
            ->where('user_id', auth()->id() ?? null) // لو حابب فلتر على الطالب الحالي
            ->latest('created_at'); // آخر إجابة حسب وقت الإنشاء
    }
}
