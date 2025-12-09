<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grade extends Model
{

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'grade_id');
    }
}
