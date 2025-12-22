<?php

namespace App\Http\Requests\Student\TopicWise;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class TopicWiseRequest extends BaseRequest
{



    public function rules(): array
    {
        return [
            'subject_id'  => 'required|exists:subjects,id',
            'topic_id'    => 'nullable|exists:topics,id',
            'subtopic_id' => 'nullable|exists:subtopics,id',
            'count' => 'required|integer'
        ];
    }
}
